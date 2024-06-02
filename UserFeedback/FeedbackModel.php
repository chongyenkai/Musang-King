//Model
<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $allowedFields = ['name', 'email', 'feedback'];
}