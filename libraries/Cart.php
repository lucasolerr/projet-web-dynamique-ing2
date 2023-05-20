<?php

class Cart
{
    public function getProducts(): array
    {
        return [
            [
                'name' => 'test',
                'price' => 1302
            ],
            [
                'name' => 'Peluche',
                'price' => 20
            ]
        ];
    }
}
