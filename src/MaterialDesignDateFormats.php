<?php

namespace  Jacquesbagui\MaterialDate;

/**
 * Created by Jean Jacques Bagui on 24/04/2016.
 */
class  MaterialDesignDateFormats
{


    public function display($datetime){

      $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
      $time_ago = strtotime($datetime);
      $cur_time   = time();
      $time_elapsed   = $cur_time - $time_ago;
      $seconds    = $time_elapsed ;
      $minutes    = round($time_elapsed / 60 );
      $hours      = round($time_elapsed / 3600);
      $days       = round($time_elapsed / 86400 );
      $weeks      = round($time_elapsed / 604800);
      $months     = round($time_elapsed / 2600640 );
      $years      = round($time_elapsed / 31207680 );

      $date = date_create_from_format('Y-m-d H:i:s', $datetime);

      // Seconds
      if($seconds <= 60){
        if($lang == "fr"){
          return "A l'instant";
        }else{
          return "Just now";
        }
      }

      //Minutes
      else if($minutes <=60){
        if($lang == "fr"){
          if($minutes==1){
              return "une minute auparavant";
          }else{
              return "il y a $minutes minutes";
          }
        }else{
          if($minutes==1){
              return "one minute ago";
          }else{
              return "$minutes minutes ago";
          }
        }
      }

      //Hours
      else if($hours <=24){
        if($lang == "fr"){
          if($hours==1){
              return "il y a une heure";
          }else{
              return "il y a $hours hrs";
          }
        }else{
          if($hours==1){
              return "an hour ago";
          }else{
              return "$hours hrs ago";
          }
        }
      }

      //Jours
      else if($days <= 7){
          if($lang == "fr"){
            if($days==1){
                return "hier à " . date_format($date, 'H:i');
            }else{
                return " il y a $days jours";
            }
          }else{
            if($days==1){
                return "yesterday at " . date_format($date, 'H:i');
            }else{
                return "$days days ago";
            }
          }
      }
      //Semaines
      else if($weeks <= 4.3){
        if($lang == "fr"){
          if($weeks==1){
              return "il y a une semaine";
          }else{
              return " il y a $weeks semaines";
          }
        }else{
          if($weeks==1){
              return "A week ago";
          }else{
              return "$weeks weeks ago";
          }
        }

      }
      //Mois
      else if($months <=12){

        return $this->pastContext($datetime);
      }
      //Years
      else{
          return $this->futureContext($datetime);
      }
    }

  public function currentYear($datetime){
    $date = date_create_from_format('Y-m-d H:i:s', $datetime);
    $currentYear = date("Y");
    $paramYear = date_format($date, 'Y');

    if($currentYear == $paramYear){
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

   public function futureContext($datetime){
     //retrieve the browser Date
     $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

     $date = date_create_from_format('Y-m-d H:i:s', $datetime);
     $futureday = date_format($date, 'j M, g:i a');
     return $futureday;
   }

   /**
    * When referring to a past time, display both date and time. : Reminded Jan 5, 7:16 AM
    *
    * @param DateTime
    * @return
    */

    public function pastContext($datetime){
      //retrieve the browser Date
      $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

      $date = date_create_from_format('Y-m-d H:i:s', $datetime);
      $pastday = date_format($date, 'M, j g:i a');
      return $pastday;
    }
    /**
     * Omit the time for events in the distant past : 3 Jan
     *
     * @param DateTime
     * @return
     */

     public function distancePastContext($datetime){
       //retrieve the browser Date
       $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

       $date = date_create_from_format('Y-m-d H:i:s', $datetime);
       $distancepassday = date_format($date, 'j M');
       return $distancepassday;
     }
     /**
      * When referring to a day of the week, such as for Calendar invites,
      * display the abbreviated day separated by a comma. : Mon, Jan 10, 8:00 AM
      *
      * @param DateTime
      * @return
      */
     public function weekdayContext($datetime){

       $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

       $date = date_create_from_format('Y-m-d H:i:s', $datetime);
       $weekday = date_format($date, 'D, M j, g:i a');

       return $weekday;
     }

}
