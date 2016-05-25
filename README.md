# LDAP for Laravel #

By Rich Marisa, May, 2016

This package integrates LDAP support into Laravel 5.

After installing Laravel, your project will contain a composer.json file, containing several sections like "require" and "require-dev". Edit this composer.json file in two places.

1. Add, or extend, the repositories array.


    "repositories": [{
      "type": "package",
      "package": {
          "name": "citcustomapps/ldap",
          "version": "0.1.0",
          "source": {
                  "url": "git@server.co.uk:Repository.git",
              "type": "git",
          "reference": "0.1.0"
          }
          }
    }],

2. Add the ldap library to the "require" array as in the following example:

    "require": {
        "php": ">=5.5.9",
        "laravel/framework": "5.2.*",
        "laravelcollective/html": "~5.2",
        "citcustomapps/ldap": "0.1.0"
    },


Now you can use composer to fetch the library:

    php composer update

Next register the LDAP class in app/config/app.php. In the 'providers' section, add 

    App\Providers\LDAPServiceProvider::class,

Add the following lines to your project's .env file, including the correct values for your LDAP credentials:

LDAP_SERVER=
LDAP_USER=
LDAP_PASS=

To use the package, include the LDAP class in one of your controllers

    use App\Helpers\LDAP;

Inject the LDAP class as a dependency in one of your methods, 
and call the data class to return information about the logged in user 
(whose netid should be found in Session::get("username")).

Example:

    public function userdata(Request $request, LDAP $ldap)
    {
        return view("controller.userdata", $ldap);
    }


### Notes ###

I used this page as a reference in creating this library: 
http://www.andrew-kirkpatrick.com/2012/10/add-a-git-repository-as-a-package-using-composer-for-php/

I used this page as a reference for creating the Laravel Service Provider:
https://laraveltips.wordpress.com/2015/06/11/how-to-create-a-service-provider-in-laravel-5-1/

