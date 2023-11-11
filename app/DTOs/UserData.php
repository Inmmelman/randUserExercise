<?php
namespace App\DTOs;

/**
 * Class UserData
 *
 * Data Transfer Object for user data.
 */
class UserData
{
    public $fullName;
    public $phone;
    public $email;
    public $country;

    public function __construct(string $fullName, string $phone, string $email, string $country)
    {
        $this->fullName = $fullName;
        $this->phone = $phone;
        $this->email = $email;
        $this->country = $country;
    }

    public function toArray()
    {
        return [
            'fullName' => $this->fullName,
            'phone' => $this->phone,
            'email' => $this->email,
            'country' => $this->country,
        ];
    }

    public static function fromArray($data)
    {
        return new self(
            $data['name']['first'] . ' ' . $data['name']['last'],
            $data['phone'],
            $data['email'],
            $data['location']['country']
        );
    }
}

