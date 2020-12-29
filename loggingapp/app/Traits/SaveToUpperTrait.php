<?php 
namespace App\Traits;


trait SaveToUpperTrait
{
    /**
     * Default params that will be saved on lowercase
     * @var array No Uppercase keys
     */
    protected $no_uppercase = [
        'id',
        'password',
        'username',
        'email',
        'remember_token',
        'slug',
    ];
    public function __get($key)
    {
        if (is_string($this->getAttribute($key))) {
            return strtoupper( $this->getAttribute($key) );
        } else {
            return $this->getAttribute($key);
        }
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);
        if (is_string($value)) {
            if($this->no_upper !== null){
                if (!in_array($key, $this->no_uppercase)) {
                    if(!in_array($key, $this->no_upper)){
                        $this->attributes[$key] = trim(strtoupper($value));
                    }
                }
            }else{
                if (!in_array($key, $this->no_uppercase)) {
                    $this->attributes[$key] = trim(strtoupper($value));
                }
            }
        }
    }

    
}
