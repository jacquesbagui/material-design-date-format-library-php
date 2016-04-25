<?php

namespace  Jacquesbagui\MaterialDate;

/**
 * Created by Jean Jacques Bagui on 24/04/2016.
 */
 class  MaterialDesignDateFormats
{
     private static $isInitialize=false;
     private static $language;
     private static $time_ago ;
     private static $cur_time ;
     private static $time_elapsed ;
     private static $seconds  ;
     private static $minutes  ;
     private static $hours ;
     private static $days  ;
     private static $weeks ;
     private static $months ;
     private static $years ;
     private static $date;

     private static function intializeMaterialDesignDateFormats(){
         if (self::$isInitialize)
             return;
         self::$isInitialize = true;
     }

     public function __construct(){
         self::intializeMaterialDesignDateFormats();
     }

     public static function initDate($datetime){
         self::$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
         self::$time_ago = strtotime($datetime);
         self::$cur_time   = time();
         self::$time_elapsed   = self::$cur_time - self::$time_ago;
         self::$seconds    = self::$time_elapsed ;
         self::$minutes    = round(self::$time_elapsed / 60 );
         self::$hours      = round(self::$time_elapsed / 3600);
         self::$days       = round(self::$time_elapsed / 86400 );
         self::$weeks      = round(self::$time_elapsed / 604800);
         self::$months     = round(self::$time_elapsed / 2600640 );
         self::$years      = round(self::$time_elapsed / 31207680 );
         self::$date = date_create_from_format('Y-m-d H:i:s', $datetime);
     }

     public static function display(){
      // Seconds
      if(self::$seconds <= 60){
        if(self::$language == "fr"){
          return "A l'instant";
        }else{
          return "Just now";
        }
      }

      //Minutes
      else if(self::$minutes <=60){
        if(self::$language == "fr"){
          if(self::$minutes==1){
              return "une minute auparavant";
          }else{
              return 'il y a '.self::$minutes.' minutes';
          }
        }else{
          if(self::$minutes==1){
              return "one minute ago";
          }else{
              return self::$minutes.' minutes ago';
          }
        }
      }

      //Hours
      else if(self::$hours <=24){
        if(self::$language == "fr"){
          if(self::$hours==1){
              return "il y a une heure";
          }else{
              return 'il y a '.self::$hours.'  hrs';
          }
        }else{
          if(self::$hours==1){
              return "an hour ago";
          }else{
              return self::$hours.' hrs ago';
          }
        }
      }

      //Jours
      else if(self::$days <= 7){
          if(self::$language == "fr"){
            if(self::$days==1){
                return "hier à " . date_format(self::$date, 'H:i');
            }else{
                return ' il y a '.self::$days.' jours';
            }
          }else{
            if(self::$days==1){
                return "yesterday at " . date_format(self::$date, 'H:i');
            }else{
                return self::$days .'days ago';
            }
          }
      }
      //Semaines
      else if(self::$weeks <= 4.3){
        if(self::$language == "fr"){
          if(self::$weeks==1){
              return "il y a une semaine";
          }else{
              return ' il y a '.self::$weeks.' semaines';
          }
        }else{
          if(self::$weeks==1){
              return "A week ago";
          }else{
              return self::$weeks .'weeks ago';
          }
        }

      }
      //Mois
      else if(self::$months <=12){

        return self::pastContext();
      }
      //Years
      else{
          return self::futureContext();
      }
    }

  public static function currentYear(){
      self::$date = date_create_from_format('Y-m-d H:i:s', self::$datetime);
      self::$currentYear = date("Y");
      self::$paramYear = date_format(self::$date, 'Y');

    if(self::$currentYear == self::$paramYear){
      return true;
    }else{
      return false;
    }
  }
  //  Date and time modifications by context
  /**
   * Include time to a future day or date : 10 Jan, 08:00
   *
   * @param DateTime
   * @return
   */

   public static function futureContext(){
     //retrieve the browser Date
       $futureday = date_format(self::$date, 'j M, g:i a');
     return $futureday;
   }

   /**
    * When referring to a past time, display both date and time. : Reminded Jan 5, 7:16 AM
    *
    * @param DateTime
    * @return
    */

    public static function pastContext($datetime){
      //retrieve the browser Date

      $pastday = date_format(self::$date, 'M, j g:i a');
      return $pastday;
    }
    /**
     * Omit the time for events in the distant past : 3 Jan
     *
     * @param DateTime
     * @return
     */

     public static function distancePastContext(){
       //retrieve the browser Date

       $distancepassday = date_format(self::$date, 'j M');
       return $distancepassday;
     }
     /**
      * When referring to a day of the week, such as for Calendar invites,
      * display the abbreviated day separated by a comma. : Mon, Jan 10, 8:00 AM
      *
      * @param DateTime
      * @return
      */
     public static function weekdayContext(){


       $weekday = date_format(self::$date, 'D, M j, g:i a');

       return $weekday;
     }

}
