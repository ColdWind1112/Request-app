<?php

namespace Controllers;

use Libraries\Requests;
use Libraries\Validator;

class RecordsController extends Controller
{

    public function index()
    {
        $library = new Requests();
        $data = $library->makeRequest();
        $this->set(['items' => json_decode($data, true)['items']]);
        $this->render('index');
    }

    public function show($id = null)
    {
        $this->render('not-found');
    }

    public function add()
    {
        $errors = [];

        if (false === empty($_POST)) {
            $validator = new Validator();
            $errors = $validator->validate($_POST);
            $data = $validator->clean($_POST);
            if (true === empty($errors)) {
                $library = new Requests();
                $library->makeRequest('POST', 'record', json_encode($data));
                header('Location: /records');
            }
        }

        $this->set(['form' => $_POST]);
        $this->set(['errors' => $errors]);
        $this->render('add');
    }


    public function delete($id = null)
    {
        if (true === is_null($id)) {
            $this->render('not-found');
            return;
        }

        $library = new Requests();
        $library->makeRequest('DELETE', 'record/' . $id);
        header('Location: /records');
    }

    public function update($id = null)
    {
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
                $library->makeRequest('PUT', 'record/' . $id, json_encode($data));
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
