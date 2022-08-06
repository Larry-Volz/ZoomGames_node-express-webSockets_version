<?php

namespace Uncgits\ZoomApi\Traits;

trait SetsCallParameters
{
    /**
     * Fluent setter for 'start' parameter
     *
     * @param int $start
     * @return void
     */
    public function setStart(int $start)
    {
        return $this->addParameters(['start' => $start]);
    }

    /**
     * Fluent setter for 'end' parameter
     *
     * @param int $end
     * @return void
     */
    public function setEnd(int $end)
    {
        return $this->addParameters(['end' => $end]);
    }

    public function addParameters(array $parameters)
    {
        $this->adapter->addParameters($parameters);
        return $this;
    }

    public function setParameters(array $parameters)
    {
        $this->adapter->setParameters($parameters);
        return $this;
    }

    public function getParameters()
    {
        return $this->adapter->getParameters();
    }

    public function withoutAuthorizationHeader()
    {
        $this->adapter->withoutAuthorizationHeader();
        return $this;
    }

    public function urlEncodeParameters()
    {
        $this->adapter->urlEncodeParameters();
        return $this;
    }
}
