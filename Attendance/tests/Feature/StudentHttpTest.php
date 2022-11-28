<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentHttpTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_all_student(){
        $response = $this->get('/students');
        $response->assertStatus(200);
    }

    public function test_add_student_no_fail(){
        $student = Student::factory()->create();
        $data = ["name" => $student->name, "surname" => $student->surname];
        $response = $this->postJson('/students/add', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('students', ['id' => $student->id, "name" => $student->name, "surname" => $student->surname]);
    }


    public function test_add_student_fail(){
        $response = $this->postJson('/students/add', []);
        $response->assertStatus(401);
    }

    public function test_delete_student(){
        $student = Student::inRandomOrder()->first();
        $data = ["id" => $student->id];
        $response = $this->deleteJson('/students/delete', $data);
        $response->assertStatus(201);
        // SOFT DELETE
        $this->assertDatabaseHas('students', ['id' => $student->id, "name" => $student->name, "surname" => $student->surname, "deleted_at" => now()]);

    }
}
