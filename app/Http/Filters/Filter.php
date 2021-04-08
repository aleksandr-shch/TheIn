<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Filter query
     * @param Builder $builder
     * @return mixed
     */
    abstract protected function applyQuery(Builder $builder);

    /**
     * Filter query key
     * @return string
     */
    abstract public function key():string;

    /**
     * Check request contains filter
     * @return bool
     */
    public function inRequest(): bool
    {
        return $this->request->query->has(
            $this->key()
        );
    }

    /**
     * Filter value
     * @return mixed
     */
    protected function value()
    {
        return $this->request->query->get(
            $this->key()
        );
    }

    /**
     * Filter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply filter
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        if ($this->inRequest()) {
            $this->applyQuery($builder);
        }
    }
}
