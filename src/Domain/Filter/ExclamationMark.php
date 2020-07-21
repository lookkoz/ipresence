<?php
declare(strict_types=1);

namespace Ipresence\Domain\Filter;

class ExclamationMark extends Filter {

    public function getValue(): string
    {
        $value = $this->quote->getValue();
        switch (substr($value, -1)) {
            case '!':
            break;
            case '.':
                $value = substr($value, 0, strlen($value)-1).'!';
            break;
            default:
                $value .= '!';
            break;
        }
        
        return $value;
    }

    
}