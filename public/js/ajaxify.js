/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    function isFunction(functionToCheck) {
        var getType = {};
        return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
    }
    $.fn.ajaxify = function (options) {

        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            EelementToReplace: "body",
            URL: "http://google.com",
            METHOD: "GET",
            DATA: '',
            dataType: "text/html",
            AjaxDoneCallback: "",
            AjaxFailedCallback: "",
            BeforeReplacementCallback: "",
            AfterReplacementCallback: ""

        }, options);

        var ajaxing = {
            getHtml: function () {
                $.ajax({
                    url: settings.url,
                    type: settings.Method,
                    data: settings.DATA,
                    dataType: settings.dataType,
                }).done(function ($data) {
                    $success = isFunction(settings.AfterReplacementCallback) ? settings.AfterReplacementCallback($data) : "";
                    
                    console.log(ajaxing.ReplaceElement($(settings.EelementToReplace),$(settings.EelementToReplace,$data)));

                    return isFunction(settings.AfterReplacementCallback) ? settings.AfterReplacementCallback($data, $success) : "";

                }).fail(function (xhr, status, errorThrown) {
                    return isFunction(settings.AjaxFailedCallback) ? settings.AjaxFailedCallback(xhr, status, errorThrown) : "";

                }).always(function (xhr, status) {
                    console.log("The request to " + settings.URL + " complete!"+" "+status);
                    return isFunction(settings.AjaxDoneCallback) ? settings.AjaxDoneCallback(xhr, status) : "";
                });
            },
            FilterElement: function ($html) {
                return  console.log("filtered element",$($html).filter(settings.EelementToReplace));
            },
            ReplaceElement: function ($element, $html) {
                return  $element.html($($html));

            }
        }

        $html = ajaxing.getHtml(settings);
            
        // Greenify the collection based on the settings variable.
        return this.css({
            color: settings.color,
            backgroundColor: settings.backgroundColor
        });

    };

}(jQuery));

