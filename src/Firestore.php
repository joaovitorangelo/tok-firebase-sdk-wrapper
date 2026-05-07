<?php

namespace Tok\Firebase;

class Firestore
{
    private string $projectId;
    private string $token;

    public function __construct(Client $client)
    {
        $this->projectId = $client->project_id();
        $this->token = $client->access_token();
    }

    private function base_url(): string
    {
        return "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/documents";
    }

    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type'  => 'application/json',
        ];
    }

    /**
     * Converte valores PHP -> Firestore
     */
    private function encode_fields(array $data): array
    {
        $fields = [];

        foreach ($data as $key => $value) {

            if (is_int($value)) {

                $fields[$key] = [
                    'integerValue' => $value
                ];

            } elseif (is_bool($value)) {

                $fields[$key] = [
                    'booleanValue' => $value
                ];

            } elseif (is_float($value)) {

                $fields[$key] = [
                    'doubleValue' => $value
                ];

            } else {

                $fields[$key] = [
                    'stringValue' => (string) $value
                ];
            }
        }

        return $fields;
    }

    /**
     * Converte Firestore -> PHP
     */
    private function decode_fields(array $fields): array
    {
        $result = [];

        foreach ($fields as $key => $value) {

            $type = array_key_first($value);

            $result[$key] = $value[$type];
        }

        return $result;
    }

    /**
     * Lista documentos
     */
    public function collection(string $collection): array
    {
        $response = wp_remote_get(
            $this->base_url() . '/' . $collection,
            [
                'headers' => $this->headers()
            ]
        );

        $body = json_decode(
            wp_remote_retrieve_body($response),
            true
        );

        $documents = [];

        if (empty($body['documents'])) {
            return [];
        }

        foreach ($body['documents'] as $document) {

            $documents[] = [
                'id' => basename($document['name']),
                'data' => $this->decode_fields(
                    $document['fields'] ?? []
                )
            ];
        }

        return $documents;
    }

    /**
     * Busca documento
     */
    public function document(string $collection, string $id): ?array
    {
        $response = wp_remote_get(
            $this->base_url() . '/' . $collection . '/' . $id,
            [
                'headers' => $this->headers()
            ]
        );

        $body = json_decode(
            wp_remote_retrieve_body($response),
            true
        );

        if (isset($body['error'])) {
            return null;
        }

        return [
            'id' => $id,
            'data' => $this->decode_fields(
                $body['fields'] ?? []
            )
        ];
    }

    /**
     * Cria/atualiza documento
     */
    public function set(string $collection, string $id, array $data): array
    {
        $response = wp_remote_request(
            $this->base_url() . '/' . $collection . '/' . $id,
            [
                'method'  => 'PATCH',
                'headers' => $this->headers(),
                'body'    => json_encode([
                    'fields' => $this->encode_fields($data)
                ])
            ]
        );

        return json_decode(
            wp_remote_retrieve_body($response),
            true
        );
    }

    /**
     * Remove documento
     */
    public function delete(string $collection, string $id): bool
    {
        $response = wp_remote_request(
            $this->base_url() . '/' . $collection . '/' . $id,
            [
                'method'  => 'DELETE',
                'headers' => $this->headers()
            ]
        );

        $code = wp_remote_retrieve_response_code($response);

        return $code === 200;
    }
}