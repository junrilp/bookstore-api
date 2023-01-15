<?php
    namespace App\Services;

    use Illuminate\Support\Facades\Http;

    class ExternalRestApiServices {

        private $baseUrl;

        public function __construct()
        {
            $this->baseUrl = 'https://dummyjson.com/products';
        }

        public function getServices(int $limit)
        {
            $res = Http::get($this->baseUrl . '?limit=' . $limit);
            return json_decode($res);
        }

        public function getSpecificService(int $id)
        {
            $res = Http::get($this->baseUrl . '/' . $id);
            return json_decode($res);
        }

        public function addService($form)
        {
            $res = Http::post($this->baseUrl .'/add', $form);
            return json_decode($res);
        }

        public function updateService($form, $id)
        {
            $res = Http::patch($this->baseUrl .'/' . $id, $form);
            return json_decode($res);
        }

        public function deleteService($id)
        {
            $res = Http::delete($this->baseUrl .'/' . $id);
            return json_decode($res);
        }
    }