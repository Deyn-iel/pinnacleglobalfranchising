<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

oh nag error sa pag submit pero nag sasubmit na, nag error lang "# Illuminate\Database\QueryException - Internal Server Error

SQLSTATE[22007]: Invalid datetime format: 1366 Incorrect integer value: 'on' for column `pinnacle_databse`.`franchise_applications`.`consent_intro` at row 1 (Connection: mysql, SQL: insert into `franchise_applications` (`consent_intro`, `email`, `lead_source`, `personal_full_name`, `personal_photo`, `personal_gender`, `personal_civil_status`, `personal_age`, `personal_country_birth`, `personal_nationality`, `personal_residence`, `personal_address`, `personal_contact`, `personal_tin`, `personal_religion`, `personal_hobbies`, `personal_spouse`, `personal_dependents`, `professional_education`, `professional_school`, `professional_employment`, `professional_occupation`, `professional_job_title`, `professional_company`, `professional_years`, `professional_company_address`, `professional_responsibilities`, `professional_business_nature`, `professional_company_contact`, `business_experience`, `business_name`, `business_years`, `business_industry`, `business_closed`, `business_closure_reason`, `business_venture_description`, `ki_customer`, `ki_affiliated`, `ki_affiliated_details`, `ki_has_coffee_shop`, `ki_industry_knowledge`, `ki_passion`, `ki_eagerness`, `proposal_location`, `proposal_reason`, `proposal_expectations`, `proposal_involvement`, `proposal_philosophy`, `proposal_interests`, `proposal_affiliations`, `financial_investment`, `financial_expected_sales`, `financial_roi`, `references`, `consent_final`, `government_id`, `updated_at`, `created_at`) values (on, atchoyalindayu@gmail.com, FACEBOOK, Mark Daniel Pascual Alindayu, profile_photos/Xp96uYl7ar3XGE24gJuaZ5sHYMXsvUCjnNZXRZA8.png, MALE, SINGLE, 22, Philippines, filipino, Philippines, Labinab Grande, Reina Mercedes, Isabela, +639937259373, 1234567890, born again, basketball, na, dan
22, College, 2022, Employed, Proprietor, na, NA, NA, Labinab Grande, Reina Mercedes, Isabela, na, NA, 09937259373, yes, NA, NA, NA, yes, na, na, yes, yes, Manila, yes, yes, yes, 10, Labinab Grande, Reina Mercedes, Isabela, na, na, na, na, na, na, awd, awdaw, awd, dan
09054593484
dan@gmail.com, on, ids/VGvbznUREkfjlOI0rtPVzmfuucwOmsDUhdIYGKk7.png, 2025-12-10 06:53:32, 2025-12-10 06:53:32))

PHP 8.2.12
Laravel 12.40.2
127.0.0.1:8000

## Stack Trace

0 - vendor\laravel\framework\src\Illuminate\Database\Connection.php:824
1 - vendor\laravel\framework\src\Illuminate\Database\Connection.php:778
2 - vendor\laravel\framework\src\Illuminate\Database\MySqlConnection.php:42
3 - vendor\laravel\framework\src\Illuminate\Database\Query\Processors\MySqlProcessor.php:35
4 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3853
5 - vendor\laravel\framework\src\Illuminate\Database\Eloquent\Builder.php:2235
6 - vendor\laravel\framework\src\Illuminate\Database\Eloquent\Model.php:1436
7 - vendor\laravel\framework\src\Illuminate\Database\Eloquent\Model.php:1401
8 - vendor\laravel\framework\src\Illuminate\Database\Eloquent\Model.php:1240
9 - vendor\laravel\framework\src\Illuminate\Database\Eloquent\Builder.php:1219
10 - vendor\laravel\framework\src\Illuminate\Support\helpers.php:390
11 - vendor\laravel\framework\src\Illuminate\Database\Eloquent\Builder.php:1218
12 - vendor\laravel\framework\src\Illuminate\Support\Traits\ForwardsCalls.php:23
13 - vendor\laravel\framework\src\Illuminate\Database\Eloquent\Model.php:2540
14 - vendor\laravel\framework\src\Illuminate\Database\Eloquent\Model.php:2556
15 - app\Http\Controllers\FranchiseController.php:98
16 - vendor\laravel\framework\src\Illuminate\Routing\ControllerDispatcher.php:46
17 - vendor\laravel\framework\src\Illuminate\Routing\Route.php:265
18 - vendor\laravel\framework\src\Illuminate\Routing\Route.php:211
19 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:822
20 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:180
21 - vendor\laravel\boost\src\Middleware\InjectBoost.php:22
22 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
23 - vendor\laravel\framework\src\Illuminate\Routing\Middleware\SubstituteBindings.php:50
24 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
25 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken.php:87
26 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
27 - vendor\laravel\framework\src\Illuminate\View\Middleware\ShareErrorsFromSession.php:48
28 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
29 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:120
30 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:63
31 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
32 - vendor\laravel\framework\src\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse.php:36
33 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
34 - vendor\laravel\framework\src\Illuminate\Cookie\Middleware\EncryptCookies.php:74
35 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
36 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:137
37 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:821
38 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:800
39 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:764
40 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:753
41 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:200
42 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:180
43 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TransformsRequest.php:21
44 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull.php:31
45 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
46 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TransformsRequest.php:21
47 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TrimStrings.php:51
48 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
49 - vendor\laravel\framework\src\Illuminate\Http\Middleware\ValidatePostSize.php:27
50 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
51 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance.php:109
52 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
53 - vendor\laravel\framework\src\Illuminate\Http\Middleware\HandleCors.php:48
54 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
55 - vendor\laravel\framework\src\Illuminate\Http\Middleware\TrustProxies.php:58
56 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
57 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks.php:22
58 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
59 - vendor\laravel\framework\src\Illuminate\Http\Middleware\ValidatePathEncoding.php:26
60 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
61 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:137
62 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:175
63 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:144
64 - vendor\laravel\framework\src\Illuminate\Foundation\Application.php:1220
65 - public\index.php:20
66 - vendor\laravel\framework\src\Illuminate\Foundation\resources\server.php:23

## Request

POST /franchise/submit

## Headers

* **host**: 127.0.0.1:8000
* **connection**: keep-alive
* **content-length**: 1722102
* **cache-control**: max-age=0
* **sec-ch-ua**: "Chromium";v="142", "Google Chrome";v="142", "Not_A Brand";v="99"
* **sec-ch-ua-mobile**: ?0
* **sec-ch-ua-platform**: "Windows"
* **origin**: http://127.0.0.1:8000
* **content-type**: multipart/form-data; boundary=----WebKitFormBoundaryeOx2fYZB99O3Xdjf
* **upgrade-insecure-requests**: 1
* **user-agent**: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36
* **accept**: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
* **sec-fetch-site**: same-origin
* **sec-fetch-mode**: navigate
* **sec-fetch-user**: ?1
* **sec-fetch-dest**: document
* **referer**: http://127.0.0.1:8000/franchise-application-process
* **accept-encoding**: gzip, deflate, br, zstd
* **accept-language**: en-AU,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,es;q=0.6,fil;q=0.5
* **cookie**: cookie_warning_dismissed=true; cookie_terms_accepted=true; XSRF-TOKEN=eyJpdiI6IkN4Q1BIMFE0RlV6V2cvelZCUEF6Q3c9PSIsInZhbHVlIjoiS3BVQ29Oa1ZXWC9SOExEN1NoQ1pQeWVRU3dTM2FlZmkzZlVwVGM5NmxQdzFvcUJiSVlDYUluR09tNHp5TkdraFZDdm9jdHdBT1h0bC9IbFRrYXkxbXY2ZEhUcms2Nko2RVFUcGpqL05jK2NISUpDU2k4VVI5MEE0TnJEY3hYQTYiLCJtYWMiOiI0ZDA2NmM1MGUyY2QyMjllYTM3Mzc3ZGNhYzM2YjIzOGVlNzYwZmVhNmVhNmY2YjU3Y2JjZDMwZDIwNDc1MWRiIiwidGFnIjoiIn0%3D; laravel-session=eyJpdiI6IktIYTdWWXBSOTNHUmxWUUhLaTRTM1E9PSIsInZhbHVlIjoiTEZOTStsTlZmL3hOWFNYUHNBT3RDVjM1Q1BDWUgwVkpXa2pEY2lieXBMOUQ4Z3FSdVpBNC9wV0ZkK3ZiRDVSeEtacy9VTm4xWDJtNjZLY2ZHcWc5MXp2bkdkaHF1WTBYb3VzQjVveGhrc0U5VUNuK0RWMXp6djhEM1ZXaWhtRFQiLCJtYWMiOiIzYmEzZjc4MWI3ZGIxMTAwYWFjZjc4OTVmMjRhMTFkZGFmNmZkM2IyOWJiNGNkOGM3NDUyMDk1YjJiODRlZWZiIiwidGFnIjoiIn0%3D

## Route Context

controller: App\Http\Controllers\FranchiseController@store
route name: franchise.submit
middleware: web

## Route Parameters

No route parameter data available.

## Database Queries

* mysql - select * from `sessions` where `id` = '4LwOrwK1fXVzaq7k0aLvYLwQNMllrlPqP7Sf1eYT' limit 1 (17.14 ms)
* mysql - select * from `users` where `id` = 2 limit 1 (0.41 ms) "