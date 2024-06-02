//Controller
<?php

namespace App\Controllers;

use App\Models\FeedbackModel;
use CodeIgniter\Controller;

class Feedback extends Controller
{
    public function index()
    {
        return view('feedback_form');
    }

    public function submit()
    {
        $model = new FeedbackModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'feedback' => $this->request->getPost('feedback'),
        ];

        if ($model->insert($data)) {
            return redirect()->to('/feedback/success');
        } else {
            return redirect()->to('/feedback/error');
        }
    }

    public function success()
    {
        return view('feedback_success');
    }

    public function error()
    {
        return view('feedback_error');
    }
}