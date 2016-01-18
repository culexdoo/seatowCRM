/**
 * testing purposes
 * only for testing
 */
var local = 'http://localhost/cityhub/cityhub/public_html/';
var testLive = 'http://mycity-hub.com/';
var demoCity = 'http://demo.mycity-hub.com/';
var betaCity = 'http://beta.mycity-hub.com/';
var liveMyCityDe = '';
var url = 'http://mrkva.k-informatika.com';

cityhub
/**
 * application constants
 */
    .constant('VERSION', '3.0.2')
    .constant('MODULES', {
        'CS': 1,
        'CN': 2,
        'TI': 3
    })
    .constant('DEBUG', true)
    .constant('PATHS', {
        'BASE': url + 'api/v1/',
        'URL_CHECK': 'http://cityhub.com.hr/387e4d6b7f574a81148ac443751924d4.php',
        'IMAGES': url + 'uploads/communalService/',
        'IMAGES_THUMB': url + 'uploads/communalService/thumbs/',
        'IMAGES_CN': url + 'uploads/cityNews/',
        'IMAGES_THUMB_CN': url + 'uploads/cityNews/thumbs/',
        'IMAGES_CITY': url + 'uploads/core/cities/',
        'IMAGES_THUMB_TI': url + 'uploads/touristInformation/thumbs/',
        'IMAGES_TI': url + 'uploads/touristInformation/'
    })
    .constant('ANONYMOUS', {
        'USERNAME': 'anonymous@cityhub.com.hr',
        'PASSWORD': 'anonymous'
    })
    .constant('SOCIAL', {
        'FACEBOOK': {
            'APP_ID': '341384832723371',
            'SCOPE': ['email'],
            'CLIENT_SECRET': '57f0fbc403b11de7aa2b2a5df4a777f3',
            'REDIRECT_URL': 'http://localhost'
        },
        'GOOGLE': {
            'CLIENT_ID': '1089029585693-ofa42duse4er3q9d9t5u5s08dn1s1go5.apps.googleusercontent.com',
            'CLIENT_SECRET': 'xrcyRRto2QN4Ff0jcslb1fR5',
            'SCOPE': ['https://www.googleapis.com/auth/plus.login', 'https://www.googleapis.com/auth/userinfo.email'],
            'REDIRECT_URL': 'http://localhost'
        },
        'DEFAULT_PASS': 'CityHubDefPass123!#'
    });
