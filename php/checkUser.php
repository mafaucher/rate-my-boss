<?php

/*
 * Author: Serban Moldoveanu
 *
 * This function will take as an input the "username" and "password" introduced by
 * the user. It will call checkUser.pl Perl script which will verify if the user is
 * registered and will return a list with all the informations about the user, including
 * the array of permissions for that user. If the user is not found then the Perl script will
 * return the $result=5 as a "user not found".If he exists then the $result will be 0.
 * If the user was found then the result ( the groups permissions for that user) will be
 * passed to another Perl script, named "Permissions.pl" which will take as input an array
 * of user permissions and it will return the "menusFinal" array. This array will contains
 * all the final sub-menus disallowed for that user(for all the menus), processed in concordance
 * with the initial user permissions and also a boolean value which will indicate if the menu
 * link must be activated of not (i.e all or some sub-menus are denied then the link for the
 * menu will be desactivated and conversely) .
 */

function checkUser($usr,$psw)
{
$user = $usr; //we will use POST but for debug purposes now we used the GET method
$password = $psw;


/* * ********************************************************************************************************
 * The command which will call the Perl script passing the $user and $password arguments.
 * It will returns an array with all the informations about that user. The order of the inforamtion
 * stored in array starting with index 0 will be as follows:username,encrypted password, real name,
 * expiration date of the account, name of the client(company), string of permissions for user,
 * comments about the user.
 */
$cmd = 'perl ../perl/checkUser.pl ' . EscapeShellArg($user) . " " . EscapeShellArg($password);
$returnval = exec($cmd, $output, $loginResult);
$userName=$output[2];


//**********************************************************************************************************

/*
 * If the loginResult from the checkUser.pl is not an error and the user was found
 * then the user permissions string from previous big array will be
 * splited in individual groups strings and put every group string at every index
 * of the new permission array.
 */


if ($loginResult == 0) {
    $new_string = preg_replace('/\s/', '', $output[5]); //remove the empty indexes resulted from the checkUser.pl
    $groups = explode(',', $new_string); //split the string which contains the group permissions, and store them into an array

    $output[5] = $groups; //insert the new group permissions array back where the old group permissions string was.


    /************************************************************************************************************************** */

    /*
     * The output from previous PERL script it is passed now to  Permissions.pl script in order to find the menus and
     * sub-menus disallowed for that user. The $cmd command which will pass the user groups will be constructed in such way
     * to be able to manage an undefined no. of user groups.$cmd is concatenated and the result is passed to the PERL script.
     */
    $cmd = 'perl ../perl/Permissions.pl '; //path of the perl interpreter and the file which must be executed

    foreach ($output[5] as $group) {
        $cmd.=EscapeShellArg($group) . ' '; //create the $cmd which will include all the user groups
    }

    $returnval = exec($cmd, $menus, $result); //execute the PERL script
    $menuCount = array_shift($menus); //extract the first index (which contains the number of menus of the website) of the array outputed by the PERL script

    /*
     * If the PERL script has exited with the code 0 (success) then the output of the PERL script will be splited in two
     * because it contains on the firsts n indexes the name of the menus and their no. of sub-menus. The next part of the array
     * will contain the menus and submenus disallowed for the user.
     */

    if ($result == 0) {//if the PERL script has exited with the code 0 (success) then  split the array
        $menuCount = array_slice($menus, 0, $menus[0] + 1); //split the menus array in two indexes of the same array:  0'st index will contain the main menu name and the submenus total for it, 1'nd to final indexes will contain the unallowed menus for the user and their submenus names
        $menuDenied = array_slice($menus, $menus[0] + 1, sizeof($menus)); //contains the disallowed menus and submenus for the user


        /*
         * In the next part of the code we will process the raw data from PERL and split the first index of the raw array
         * which contains the counting for the menus and their submenus
         */

        array_shift($menuCount); //eliminate unecesarily data

        foreach ($menuCount as $value) {//split every index of the $menuCount array into another small array with 2 indexes which will contain the name of the menu and its number of submenus
            $menuCounter[] = explode(",", $value);
        }
        $finalCounterMenu = array();

        foreach ($menuCounter as $value) {//the final array which will have as keys the name of the menu and as values the number of submenus
            $finalCounterMenu[$value[0]] = $value[1]; //that will contain ALL the menus and its corespondent no. of the submenus of the website
        }

        $menusFinall = array(); //at last...declaring the real final array
        /*
         * This foreach loop will split the string which has the name of the menu and the name of submenu and put them in an array
         * which will have at the index 0:menu name and index 1: submenu name. All these arrays manipulations were necessarily to
         * adapt the PERL output to the reqiurements of the menuConstructor module.
         */
        foreach ($menuDenied as $value) {
            $temp = explode(";", $value);
            $menusFinal[] = array_slice($temp, 0, 2);
        }
        /*
         * This loop will calculate if a menu has all or some submenus denied or has any submenus denied.
         * In the case when all or some submenus are denied then the $sublink array will contains at least
         * one submenu name and the boolean associated with the menu will be set to "false" (i.e the menu
         * must be set to inactive or not displayed). In the case when $sublink is empty then the boolean
         * will be set to "true" which means that the menu must be active.
         */
        $sublink=array();
        foreach ($finalCounterMenu as $key => $value) {//foreach which fetch the $key(name of the menu) and its $value(total no. of submenus of the menu)
            $tempName = $key; //set the name of the menu
            $tempCount = $value; //set the no. of submenu

            foreach ($menusFinal as $menu) {//the array which contains the disallowed menus and their submenus is processed
                if ($menu[0] == $tempName) {//if the name of the disallowed menu its the same as the name of the menu from $finalCounterMenu then decrease the total no. of the submenus of that menu
                    $tempCount--;
                    $sublink[] = $menu[1]; //put the name of the submenu in the $sublink array
                }
            }
            if (($tempCount == 0) || ($tempCount < $value)) {//if at least one of the submenus are found then set the boolean to "true", and insert the boolean and $sublink array to the $menusFinall array which has as key the name of the corespondent menu

                $anotherTemp[] = true; //set boolean to true and insert it in the subarray
                $anotherTemp[] = $sublink; //insert the $sublink array in the subarray
                $menusFinall[$tempName] = $anotherTemp; //insert the suarray to the index with the key with the name of the menu
                unset($anotherTemp); //reset the array
                $sublink=array(); //reset the array
            }
            if ($tempCount == $value) {//if all the submenus are allowed (i.e. the initial no. of the submenus is not changed) then set boolean to "false" and insert the boolean and $sublink array(which is empty) to the $menusFinall array which has as key the name of the corespondent menu
                $anotherTemp[] = false; //insert boolean false
                $anotherTemp[] = $sublink; //insert the  $sublink array
                $menusFinall[$tempName] = $anotherTemp; //insert the subarray in the final array
                unset($anotherTemp); //reset the array
                $sublink=array(); //reset the array
            }
        }
        
    }
    //else//if the array returned is empty but the return $result from the PERl script is 0 then that means that the user don't has access to any submenus (also the menus).
        //echo "\nUser don't has access to any menu"; //message to the user
}

//else//if the return $result from the PERl script is 5 then that means that the user was nt found
  //  echo "\nNo user found! Please try again"; //message to the user
$resultsArray[]=$loginResult;
$resultsArray[]=$menusFinall;
$resultsArray[]=$userName;
return $resultsArray;
}

?>
