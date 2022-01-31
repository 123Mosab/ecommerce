<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    use Translatable;

    /**
     * the relation to eager load on every query.
     * 
     * @var arry
     */

     protected $with = ['translations'];

     protected $translatedAttributes = ['value'];

     /**
      * The attrebutes that are mass assignadle.
      *
      *@var arry
      */

      protected $fillable = ['key','is_translatble','plain_value'];

      /**
       * The attrebutes that should be case to native types.
       * 
       * @var arry
       */

       protected $casts = [
           'is_translatable' => 'boolean',
       ];

       /**
        * Set given setting.
        *
        *@param array $setting
        *@return void
        */

        public static function setMany($settings)
        {
            foreach ($settings as $key => $value)
            {
                self::set($key , $value);
            }
        }

        /**
         * Set the given setting.
         * 
         * @param string $key
         * @param mixed $value
         * @return void
         */

         public static function set($key,$value )
         {
             if ($key === 'translatable')
             {
                 return static::setTranslatableSettings($value);
             }

             if (is_array($value))
             {
                 $value = json_encode($value);
             }

             static::updateOrCreate(['key' => $key],['plain_value' => $value]);
         }

         /**
          * Set a translatable settings.
          *
          *@param array $settings
          *@return void
          */

          public static function setTranslatableSettings($settings = [])
          {
              foreach($settings as $key => $value)
              {
                  static::updateOrCreate(['key' => $key],[
                      'is_translatable' => true,
                      'value' => $value,
                  ]);
              }
          }
}
