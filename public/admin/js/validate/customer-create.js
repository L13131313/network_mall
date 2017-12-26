/**
 * Theme: Velonic Admin Template
 * Author: Coderthemes
 * Form Validator
 */

!function ($) {
    "use strict";
    var FormValidator = function () {
        this.$signupForm = $("#signupForm");
    };

    //init
    FormValidator.prototype.init = function () {
        // 姓名验证
        jQuery.validator.addMethod("isName", function (value, element) {
            var mobile = /^[0-9]*$/;
            return this.optional(element) || !mobile.test(value);
        }, "输入的姓名有误");

        // 手机号码验证
        jQuery.validator.addMethod("isMobile", function (value, element) {
            var length = value.length;
            var mobile = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1})|(14[0-9]{1}))+\d{8})$/;
            var reg = /^0\d{2,3}-?\d{7,8}$/;
            return this.optional(element) || (reg.test(value) || mobile.test(value));
        }, "请正确填写您的手机号码");

        //qq号验证
        jQuery.validator.addMethod("isQq", function (value, element) {
            var length = value.length;
            var qq = /^\d{5,12}$/;
            return this.optional(element) || (qq.test(value));
        }, "请填写正确的qq号码");


        jQuery.validator.addMethod("isEmail", function (value, element) {
            var email = /^(\w|[\u4e00-\u9fa5])+([-+.]\w+)*@(\w|[\u4e00-\u9fa5])+([-.](\w|[\u4e00-\u9fa5])+)*\.(\w|[\u4e00-\u9fa5])+([-.](\w|[\u4e00-\u9fa5])+)*$/;
            return this.optional(element) || email.test(value);
        }, "请输入正确的邮箱");

        $.validator.setDefaults({
            submitHandler: function () {
                $('button[type="submit"]').attr('disabled', 'disabled').die('click');
                form.submit();
            }
        });


        this.$signupForm.validate({
            rules: {
                stuname: {
                    required: true,
                },
                phone: {
                    required: true,
                    isMobile: true
                },
                school: "required",
                subject: "required",
                stusex: "required",
                email: {
                    isEmail: true
                }
            },
            messages: {
                stuname: {
                    required: "请输入您的名字",
                    isName: "输入的姓名有误"
                },
                phone: {
                    required: "请输入手机号码",
                    digits: "手机号格式错误",
                    isMobile: "请输入一个有效的联系电话"
                },
                qq: {
                    isQq: "请输入正确的qq号码"
                },
                school: "请选择校区",
                subject: "请选择学科",
                stusex: "请选择性别",
                email: {
                    isEmail: '填写的邮箱有误请检查输入'
                }
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function () {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });

    },
        //init
        $.FormValidator = new FormValidator, $.FormValidator.Constructor = FormValidator
}(window.jQuery),

    function ($) {
        "use strict";
        $.FormValidator.init()
    }(window.jQuery);