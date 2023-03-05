define(
    [
        'ko',
        'jquery',
        'uiComponent',
        'mage/storage',
        'mage/url'
    ],
    function (ko, $, Component, storage, url) {
        'use strict';
        return Component.extend(
            {
                defaults: {
                    template: 'BA_GoogleLogin/googlelogin'
                },
                getConfigValue: function () {
                    var serviceUrl = url.build('social/config/values');
                    storage.get(serviceUrl).done(
                        function (response) {
                            $('.google-login').text(response.btnValue);
                            $('.google-login').attr("href", response.authUrl);
                        }
                    );
                }
            }
        )
    });