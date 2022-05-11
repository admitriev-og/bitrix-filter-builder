<?php

namespace BitrixFilterBuilder;

class Filter
{
    protected $filter = [];

    public static function create()
    {
        return new Filter();
    }

    public function eq($field, $value): self
    {
        $this->filter[$field] = $value;

        return $this;
    }

    public function neq($field, $value): self
    {
        $this->filter['!' . $field] = $value;

        return $this;
    }

    public function like($field, $value): self
    {
        $this->filter[$field] = $value;

        return $this;
    }

    public function isNull($field): self
    {
        $this->filter[$field] = false;

        return $this;
    }

    public function isNotNull($field): self
    {
        $this->filter['!' . $field] = false;

        return $this;
    }

    public function in($field, $values): self
    {
        $this->filter[$field] = (array)$values;

        return $this;
    }

    public function notIn($field, $values): self
    {
        $this->filter['!' . $field] = (array)$values;

        return $this;
    }

    public function between($field, $min, $max): self
    {
        $this->filter['>=' . $field] = $min;
        $this->filter['<=' . $field] = $max;

        return $this;
    }

    public function lte($field, $value): self
    {
        $this->filter['<=' . $field] = $min;

        return $this;
    }

    public function gte($field, $value): self
    {
        $this->filter['>=' . $field] = $min;

        return $this;
    }

    public function addOrFilter(Filter $filter): self
    {
        $this->filter[] = array_merge([ 'LOGIC' => 'OR'], $filter->getResult());

        return $this;
    }

    public function getResult()
    {
        return $this->filter;
    }
}
