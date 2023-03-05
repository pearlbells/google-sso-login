<?php
namespace BA\GoogleLogin\Model\Type;

use Magento\Framework\Escaper;

class Sanitize
{
    protected $escaper;

    public function __construct(
        Escaper $escaper
    ) {
        $this->escaper = $escaper;
    }

    public function sanitizeVars($data)
    {
        foreach($data as $key => $value) {
            $data[$key] = $this->escaper->escapeHtml($value);
        }
        return $data;
    }
}