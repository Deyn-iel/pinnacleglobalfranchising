import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/js/main.js',

                //main
                'resources/css/header/app.css',
                'resources/css/footer/app.css',
                'resources/css/chatbot/app.css',
                'resources/css/main/app.css',
                'resources/css/scroll/app.css',
                'resources/css/about/app.css',
                'resources/css/franchisability/app.css',
                'resources/css/franchise-app/app.css', 
                'resources/js/franchise-app/app.js',
                'resources/css/our_service/app.css',
                'resources/css/contact/app.css',

                //ticket
                'resources/css/chatbot/ticket.css',
                'resources/js/chatbot/ticket.js',

                'resources/js/header/app.js',
                'resources/js/chatbot/app.js',
                'resources/js/scroll/app.js',
                'resources/js/main/app.js',
                'resources/js/contact/app.js',

                //userdashboard
                'resources/css/user-dashboard/app.css',
                'resources/js/user-dashboard/app.js',
                'resources/css/notifications/app.css',
                'resources/css/proceed/app.css' ,
                'resources/css/video/app.css',
                'resources/css/profile/app.css',
                'resources/css/attendance/app.css',
                'resources/css/user-exam-disabled/app.css',
                'resources/css/user-dashboard-select/app.css',
                'resources/css/registration/app.css',
        
                // js files
                'resources/js/proceed/app.js',
                'resources/js/attendance/app.js',

                //admindashboard
                'resources/css/admin/app.css',


            ],
            refresh: true,
        }),
    ],
});
