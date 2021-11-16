<?php

namespace Controllers;

use Libraries\Requests;
use Libraries\Validator;

class RecordsController extends Controller
{

    public function index()
    {
        if (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0') {
            session_unset();
        }

        $library = new Requests();
        $data = $library->makeRequest();
        $this->set(['items' => json_decode($data, true)['items']]);
        $this->render('index');
    }

    public function show($id = null)
    {
        $this->render('not-found');
    }

    private function setStatus($response, $message)
    {
        $response = json_decode($response, true);
        $status = isset($response['status']) ? $response['status'] : $response['code'];
        if ($status === 'success') {
            $_SESSION['type'] = 'success';
            $_SESSION['message'] = $message;
        } elseif ($status == 404) {
            $_SESSION['type'] = 'danger';
            $_SESSION['message'] = $response['message'];
        }
    }

    public function add()
    {
        session_unset();

        $errors = [];

        if (false === empty($_POST)) {
            $validator = new Validator();
            $errors = $validator->validate($_POST);
            $data = $validator->clean($_POST);
            if (true === empty($errors)) {
                $library = new Requests();
                $response = $library->makeRequest('POST', 'record', json_encode($data));

                $this->setStatus($response, 'New record added successfully!');
                header('Location: /records');
            }
        }

        $this->set(['form' => $_POST]);
        $this->set(['errors' => $errors]);
        $this->render('add');
    }


    public function delete($id = null)
    {
        session_unset();

        if (true === is_null($id)) {
            $this->render('not-found');
            return;
        }

        $library = new Requests();
        $response = $library->makeRequest('DELETE', 'record/' . $id);

        $this->setStatus($response, 'New record deleted successfully!');
        header('Location: /records');
    }

    public function update($id = null)
    {
        session_unset();

        if (true === is_null($id)) {
            $this->render('not-found');
            return;
        }

        $library = new Requests();


        $errors = [];

        if (false === empty($_POST)) {
            $validator = new Validator();
            $errors = $validator->validate($_POST);
            $data = $validator->clean($_POST);
            if (true === empty($errors)) {
                $response = $library->makeRequest('PUT', 'record/' . $id, json_encode($data));
                $this->setStatus($response, 'New record updated successfully!');
                header('Location: /records');
            }
        }
        if (true === empty($errors)) {
            $this->set(['form' => json_decode($library->makeRequest('GET', 'record/' . $id), true)]);
        } else {
            $this->set(['form' => $_POST]);
        }
        $this->set(['errors' => $errors]);
        $this->render('add');
    }
}
