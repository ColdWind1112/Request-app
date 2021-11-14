<?php

namespace Libraries;

class Validator
{
    private $fields = [
        'A' => [
            'content' => 'validateIpv4',
        ],
        'AAAA' => [
            'content' => 'validateIpv6'
        ],
        'MX' => [
            'content' => 'validateDomain',
            'prio' => 'validateInt'
        ],
        'ANAME' => [
            'content' => 'validateDomain',
        ],
        'CNAME' => [
            'content' => 'validateDomain',
        ],
        'NS' => [
            'content' => 'validateDomain',
        ],
        'TXT' => [],
        'SRV' => [
            'content' => 'validateDomain',
            'prio' => 'validateInt',
            'port' => 'validatePort',
            'weight' => 'validateInt'
        ]
    ];


    public function validate(array $data): array
    {
        $result = [];
        $type = $data['type'];
        foreach ($this->fields[$type] as $index => $checkMethod) {
            $error = $this->{$checkMethod}($data[$index]);
            print_r($error);
            if (false !== $error) {
                $result[$index] = $error;
            }
        }

        return $result;
    }

    private function validateDomain($item)
    {
        return filter_var($item, FILTER_VALIDATE_DOMAIN) ? false : "Domain invalid!";
    }

    private function validateInt($item)
    {
        return filter_var($item, FILTER_VALIDATE_INT) ? false : "Item is not integer number!";
    }

    private function validatePort($item)
    {
        return filter_var($item, FILTER_VALIDATE_INT) ? false : "Port number is not valid!";
    }

    private function validateIpv6($item)
    {
        return filter_var($item, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? false : "IP invalid!";
    }

    private function validateIpv4($item)
    {
        return filter_var($item, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? false : "IP invalid!";
    }

    public function clean(array $data): array
    {
        $response = [];
        foreach ($data as $index => $item) {
            $response[$index] = htmlspecialchars($item);
        }
        if (true === empty($response['ttl'])) {
            $response['ttl'] = 600;
        }
        return $response;
    }
}
