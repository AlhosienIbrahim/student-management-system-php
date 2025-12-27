<?php
class Student {
    private string $id;
    public string $name;
    private float|int $degree;
    public function __construct(string $id, string $name, float|int $degree) {
        $this->id = $id;
        $this->name = $name;
        $this->degree = $degree <= 100 && $degree > 0 ? $degree : -1;
    }
    public function getId() {
        return $this->id;
    }
    public function getDegree() {
        return $this->degree;
    }
    public function setDegree(int|float $new_degree) {
        $this->degree = $new_degree <= 100 && $new_degree > 0 ? $new_degree : -1;
    }
}