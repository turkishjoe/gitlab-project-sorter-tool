<?php


namespace App\Model;

/**
 * Class GetProjectsResult
 * @package App\Model
 */
class ProjectsResult
{
    /**
     * @var array
     */
    private $grouped;

    /**
     * @var array
     */
    private $owned;

    /**
     * @return array
     */
    public function getGrouped(): array
    {
        return $this->grouped;
    }

    /**
     * @param array $grouped
     * @return $this
     */
    public function setGrouped(array $grouped): self
    {
        $this->grouped = $grouped;
        return $this;
    }

    /**
     * @return array
     */
    public function getOwned(): array
    {
        return $this->owned;
    }

    /**
     * @param array $owned
     * @return $this
     */
    public function setOwned(array $owned): self
    {
        $this->owned = $owned;
        return $this;
    }


}