<?php
    namespace App\Controllers;

    use App\Models\Cliente;

    class ClienteController
    {
        public function get($id = null) 
        {
            if ($id) {
                return Cliente::select($id);
            } else {
                return Cliente::selectAll();
            }
        }

        public function post() 
        {
            $data = $_POST;
            
            return Cliente::insert($data);
        }

        public function put($id) 
        {

            parse_str(file_get_contents('php://input'),$result);
        
            return Cliente::update($result, $id);
        }

        public function delete($id) 
        {
            return Cliente::delete($id);
        }
    }