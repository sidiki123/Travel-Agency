jQuery(document).ready(function(e){"use strict";e(".metfrom-btn-refresh-get-response-list").click(function(){var t=e(this);t.addClass("mf-setting-spin");var i,a=e("#metform_form_modal"),o=e("#metform-form-modalinput-settings").attr("data-nonce"),s=e(".get-response-campaign-list");i=a.find("form").attr("data-mf-id"),e.ajax({url:window.metform_api.resturl+"metform/v1/entries/store_get_response_list/"+i,type:"get",headers:{"X-WP-Nonce":o},dataType:"json",success:function(e){s.empty(),e.forEach(e=>{s.append('<option value="'+e.campaignId+'">'+e.description+"</option>")}),t.removeClass("mf-setting-spin")},error:function(e){console.log(e),t.removeClass("mf-setting-spin")}})}),e(".metfrom-btn-refresh-mailchimp-list").click(function(){var t=e(this);t.addClass("mf-setting-spin");var i,a=e("#metform_form_modal"),o=e("#metform-form-modalinput-settings").attr("data-nonce"),s=e(".mailchimp_list");i=a.find("form").attr("data-mf-id"),e.ajax({url:window.metform_api.resturl+"metform/v1/entries/store_mailchimp_list/"+i,type:"get",headers:{"X-WP-Nonce":o},dataType:"json",success:function(e){console.log(e);try{s.empty(),e.lists.forEach(e=>{s.append("<option value="+e.id+">"+e.name+"</option>"),console.log(e.campaignId)})}catch(e){console.log(e)}t.removeClass("mf-setting-spin")},error:function(e){t.removeClass("mf-setting-spin")}})}),e(".metfrom-btn-refresh-hubsopt-list").click(function(){var t=e(this);t.addClass("mf-setting-spin");var i,a=e("#metform_form_modal"),o=e("#metform-form-modalinput-settings").attr("data-nonce"),s=e(".hubspot_forms");i=a.find("form").attr("data-mf-id"),e.ajax({url:window.metform_api.resturl+"metform/v1/forms/hubspot_forms/"+i,type:"get",headers:{"X-WP-Nonce":o},dataType:"json",success:function(e){try{s.empty(),e.forEach(e=>{console.log(e.name),s.append("<option value="+e.portalId+" guid="+e.guid+">"+e.name+"</option>")})}catch(e){console.log(e)}t.removeClass("mf-setting-spin")},error:function(e){t.removeClass("mf-setting-spin")}})}),e(".hubspot_forms").on("change",function(){var t=e("option:selected",this).attr("guid"),i=e("option:selected",this).val();e(".mf_hubspot_form_guid").val(t),e(".mf_hubspot_form_portalId").val(i);var a,o=e("#metform_form_modal"),s=e("#metform-form-modalinput-settings").attr("data-nonce");a=o.find("form").attr("data-mf-id"),e("#mf-hubsopt-fileds").html("Please wait....");var r="";e.ajax({url:window.metform_api.resturl+"metform/v1/forms/get_fields_data/"+a,type:"get",headers:{"X-WP-Nonce":s},dataType:"json",success:function(i){r=i,e.ajax({url:window.metform_api.resturl+"metform/v1/forms/hubspot_form_fields/"+a,type:"post",headers:{"X-WP-Nonce":s},dataType:"json",data:{guid:t},success:function(t){var i="",a="";Object.keys(r).map(function(e){return[r[e]]}).map(e=>{a+="<option value="+e[0].mf_input_name+">"+e[0].mf_input_label+"</option>"});t.forEach(e=>{i+="<tr><td>"+e.label+"</td><td><select name=mf_hubspot_form_field_name_"+e.name+' class="attr-form-control">'+a+"</select></td></tr>"}),e("#mf-hubsopt-fileds").html('<table width="100%">'+i+"</table>")},error:function(t){e("#mf-hubsopt-fileds").html("Sorry ! Something went wrong")}})},error:function(t){e("#mf-hubsopt-fileds").html("Sorry ! Something went wrong")}})}),e(".row-actions .edit a, .page-title-action, .metform-form-edit-btn, body.post-type-metform-form a.row-title").on("click",function(t){t.preventDefault();var i=0,a=e("#metform_form_modal"),o=e(this).parents(".column-title"),s=e("body").attr("data-metform-template-key");if(a.addClass("loading"),a.modal("show"),o.length>0){i=e(this).attr("data-metform-form-id"),"undefined"!==s&&(i=s),i=void 0!==i?i:o.find(".hidden").attr("id").split("_")[1];var r=e("#metform-form-modalinput-settings").attr("data-nonce");e.ajax({url:window.metform_api.resturl+"metform/v1/forms/get/"+i,type:"get",headers:{"X-WP-Nonce":r},dataType:"json",success:function(e){_(e),a.removeClass("loading")}})}else{_({form_title:e(".mf-form-modalinput-title").attr("data-default-value"),admin_email_body:"",admin_email_from:"",admin_email_reply_to:"",admin_email_subject:"",capture_user_browser_data:"",enable_admin_notification:"",limit_total_entries_status:"",limit_total_entries:"0",redirect_to:"",success_url:"",failed_cancel_url:"",require_login:"",store_entries:"1",entry_title:"",success_message:e(".mf-form-modalinput-success_message").attr("data-default-value"),user_email_body:"",user_email_from:"",user_email_reply_to:"",user_email_subject:"",input_names:"Example: [mf-inputname]"}),a.removeClass("loading")}e(".mf-register").length&&e.ajax({url:window.metform_api.resturl+"metform/v1/forms/get_fields_data/"+i,type:"get",headers:{"X-WP-Nonce":r},dataType:"json",success:function(t){var a=t,o="";e.ajax({url:window.metform_api.resturl+"xs/register/settings/"+i,type:"get",headers:{"X-WP-Nonce":r},dataType:"json",success:function(t){Object.keys(a).map(function(e){return[a[e]]}).map(e=>{o+="<option value="+e[0].mf_input_name+">"+e[0].mf_input_label+"</option>"});var i='<div class="mf-input-group mf-input-group-inline">'+('<label class="attr-input-label">User Name</label><div class="mf-inputs"><select class="attr-form-control" id="mf_auth_reg_user_name" name="mf_auth_reg_user_name">'+o+"</select></div>")+'</div><div class="mf-input-group mf-input-group-inline">'+('<label class="attr-input-label">User Email</label><div class="mf-inputs"><select class="attr-form-control" id="mf_auth_reg_user_email" name="mf_auth_reg_user_email">'+o+"</select></div>")+'</div><div class="mf-input-group mf-input-group-inline"><label class="attr-input-label">Role</label><div class="mf-inputs"><select class="attr-form-control" id="mf_auth_reg_role" name="mf_auth_reg_role"><option value="administrator">Administrator</option><option value="editor">Editor</option><option value="author">Author</option><option value="contributor">Contributor</option><option selected="selected" value="subscriber">Subscriber</option></select></div></div>';e(".mf_register_form_fields").html(i),0!=t&&(e('#mf_auth_reg_user_name option[value="'+t.mf_auth_reg_user_name+'"]').prop("selected",!0),e('#mf_auth_reg_user_email option[value="'+t.mf_auth_reg_user_email+'"]').prop("selected",!0),e('#mf_auth_reg_role option[value="'+t.mf_auth_reg_role+'"]').prop("selected",!0))},error:function(e){console.log(e)}})},error:function(e){console.log(e)}}),e(".mf-login").length&&e.ajax({url:window.metform_api.resturl+"metform/v1/forms/get_fields_data/"+i,type:"get",headers:{"X-WP-Nonce":r},dataType:"json",success:function(t){var a=t,o="";e.ajax({url:window.metform_api.resturl+"xs/login/settings/"+i,type:"get",headers:{"X-WP-Nonce":r},dataType:"json",success:function(t){Object.keys(a).map(function(e){return[a[e]]}).map(e=>{o+="<option value="+e[0].mf_input_name+">"+e[0].mf_input_label+"</option>"});var i='<div class="mf-input-group mf-input-group-inline">'+('<label class="attr-input-label">User Name</label><div class="mf-inputs"><select class="attr-form-control" id="mf_auth_login_user_name" name="mf_auth_login_user_name">'+o+"</select></div>")+'</div><div class="mf-input-group mf-input-group-inline">'+('<label class="attr-input-label">User Password</label><div class="mf-inputs"><select class="attr-form-control" id="mf_auth_login_user_password" name="mf_auth_login_user_password">'+o+"</select></div>")+"</div>";e(".mf_login_form_fields").html(i),0!=t&&(e('#mf_auth_login_user_name option[value="'+t.mf_auth_login_user_name+'"]').prop("selected",!0),e('#mf_auth_login_user_password option[value="'+t.mf_auth_login_user_password+'"]').prop("selected",!0))},error:function(e){console.log(e)}})},error:function(e){console.log(e)}}),function(t){var i=e("#metform-form-modalinput-settings").attr("data-nonce"),a=e(".get-response-campaign-list");e.ajax({url:window.metform_api.resturl+"metform/v1/entries/get_response_list/"+t,type:"get",headers:{"X-WP-Nonce":i},dataType:"json",success:function(e){a.empty(),e.length&&e.forEach(e=>{a.append("<option value="+e.campaignId+">"+e.description+"</option>")})},error:function(e){}})}(i),function(t){var i=e(".metfrom-btn-refresh-hubsopt-list");i.addClass("mf-setting-spin");var a=e("#metform-form-modalinput-settings").attr("data-nonce"),o=e(".hubspot_forms"),s=t;e.ajax({url:window.metform_api.resturl+"metform/v1/forms/get_hubspot_forms/"+s,type:"get",headers:{"X-WP-Nonce":a},dataType:"json",success:function(e){try{o.empty(),e.forEach(e=>{o.append("<option value="+e.portalId+" guid="+e.guid+">"+e.name+"</option>")})}catch(e){}i.removeClass("mf-setting-spin")},error:function(e){i.removeClass("mf-setting-spin")}})}(i),function(t){e("#metform_form_modal");var i,a=e("#metform-form-modalinput-settings").attr("data-nonce"),o=e(".mailchimp_list");i=t,e.ajax({url:window.metform_api.resturl+"metform/v1/entries/get_mailchimp_list/"+i,type:"get",headers:{"X-WP-Nonce":a},dataType:"json",success:function(e){try{o.empty(),e.lists.forEach(e=>{o.append("<option value="+e.id+">"+e.name+"</option>")})}catch(e){}},error:function(e){}})}(i),a.find("form").attr("data-mf-id",i),a.find(".get-response-campaign-list").attr("get-response-list-id",i)}),e(".metform-form-save-btn-editor").on("click",function(){e(".metform-form-save-btn-editor").attr("disabled",!0);var t=e("#metform-form-modalinput-settings");t.attr("data-open-editor","1"),t.trigger("submit")}),e("#metform-form-modalinput-settings").on("submit",function(t){t.preventDefault();var i=e("#metform-form-modal"),a=e(this);i.addClass("loading"),e(".metform-form-save-btn-editor").attr("disabled",!0),e(".metform-form-save-btn").attr("disabled",!0);var o=e(this).serialize(),s=e(this).attr("data-mf-id"),r=e(this).attr("data-open-editor"),n=e(this).attr("data-editor-url"),m=e(this).attr("data-nonce");e.ajax({url:window.metform_api.resturl+"metform/v1/forms/update/"+s,type:"post",data:o,headers:{"X-WP-Nonce":m},dataType:"json",success:function(t){e("#message").css("display","block"),1==t.saved?(e("#post-"+t.data.id).find(".row-title").html(t.data.title),e("#message").removeClass("attr-alert-warning").addClass("attr-alert-success").html(t.status)):e("#message").removeClass("attr-alert-success").addClass("attr-alert-warning").html(t.status),setTimeout(function(){e("#message").css("display","none"),a.find(".attr-close").trigger("click")},3e3),i.removeClass("loading"),"1"==r&&1==t.saved?setTimeout(function(){window.location.href=n+"?post="+t.data.id+"&action=elementor"},1500):"0"!=s?(e(".metform-form-save-btn-editor").removeAttr("disabled"),e(".metform-form-save-btn").removeAttr("disabled")):"0"==s&&setTimeout(function(){location.reload()},1500)}})});var t=e(".mf-entry-title"),i=e(".mf-form-user-confirmation"),a=e(".mf-form-admin-notification"),o=e(".mf-input-rest-api-group"),s=e(".mf-mailchimp"),r=e(".mf-get_response"),n=e(".mf-zapier"),m=e(".mf-slack"),l=e(".mf-paypal"),c=e(".mf-stripe"),f=e(".mf-ckit"),d=e(".mf-aweber"),p=e(".mf-mail-poet");function _(r){if(t.hide(),i.hide(),a.hide(),o.hide(),s.hide(),n.hide(),m.hide(),l.hide(),c.hide(),f.hide(),d.hide(),p.hide(),""!=r.form_title){e(".mf-form-modalinput-title").val(r.form_title),e(".mf-form-modalinput-success_message").val(r.success_message),e(".mf-entry-title-input").val(void 0!==r.entry_title&&""!=r.entry_title?r.entry_title:void 0===r.entry_title||""==r.entry_title?"Entry # [mf_id]":""),e(".mf-form-modalinput-redirect_to").val(r.redirect_to),e(".mf-form-modalinput-success_url").val(r.success_url),e(".mf-form-modalinput-failed_cancel_url").val(r.failed_cancel_url),e(".mf-form-modalinput-limit_total_entries").val(r.limit_total_entries);var _=e(".mf-form-modalinput-store_entries");"1"==r.store_entries?(_.attr("checked",!0),t.show()):(_.removeAttr("checked"),t.hide());var u=e(".mf-form-modalinput-hide_form_after_submission");"1"==r.hide_form_after_submission?u.attr("checked",!0):u.removeAttr("checked");var h=e(".mf-form-modalinput-require_login");"1"==r.require_login?h.attr("checked",!0):h.removeAttr("checked");var v=e(".mf-form-modalinput-limit_status");"1"==r.limit_total_entries_status?v.attr("checked",!0):v.removeAttr("checked");var g=e(".mf-form-modalinput-count_views");"1"==r.count_views?g.attr("checked",!0):g.removeAttr("checked");var b=e(".mf-form-modalinput-multiple_submission");"1"==r.multiple_submission?b.attr("checked",!0):b.removeAttr("checked");var k=e(".mf-form-modalinput-enable_recaptcha");"1"==r.enable_recaptcha?k.attr("checked",!0):k.removeAttr("checked");var w=e(".mf-form-modalinput-capture_user_browser_data");"1"==r.capture_user_browser_data?(w.attr("checked",!0),e("#multiple_submission").removeClass("hide_input"),e("#multiple_submission").addClass("show_input")):w.removeAttr("checked"),e(".mf-form-user-email-subject").val(r.user_email_subject),e(".mf-form-user-email-from").val(r.user_email_from),e(".mf-form-user-reply-to").val(r.user_email_reply_to),e(".mf-form-user-email-body").val(r.user_email_body);var y=e(".mf-form-user-enable");"1"==r.enable_user_notification?(y.attr("checked",!0),i.show()):(y.removeAttr("checked"),i.hide());var j=e(".mf-form-user-submission-copy");"1"==r.user_email_attach_submission_copy?j.attr("checked",!0):j.removeAttr("checked"),e(".mf-form-admin-email-subject").val(r.admin_email_subject),e(".mf-form-admin-email-from").val(r.admin_email_from),e(".mf-form-admin-email-to").val(r.admin_email_to),e(".mf-form-admin-reply-to").val(r.admin_email_reply_to),e(".mf-form-admin-email-body").val(r.admin_email_body);var x=e(".mf-form-admin-enable");"1"==r.enable_admin_notification?(x.attr("checked",!0),a.show()):(x.removeAttr("checked"),a.hide());var A=e(".mf-form-admin-submission-copy");"1"==r.admin_email_attach_submission_copy?A.attr("checked",!0):A.removeAttr("checked");var C=e(".mf-form-modalinput-rest_api");"1"==r.mf_rest_api?(C.attr("checked",!0),e(".mf-rest-api").show()):(C.removeAttr("checked"),e(".mf-rest-api").hide());var T=e(".mf-form-modalinput-mail_chimp");"1"==r.mf_mail_chimp?(T.attr("checked",!0),s.show()):(T.removeAttr("checked"),s.hide());let o=e(".mf-form-modalinput-ckit"),K=e(".mf-form-modalinput-mail_aweber"),L=e(".mf-form-modalinput-mail_poet");if("1"==r.mf_convert_kit?(o.attr("checked",!0),f.show()):(o.removeAttr("checked"),f.hide()),"1"==r.mf_mail_aweber?(K.attr("checked",!0),d.show()):(K.removeAttr("checked"),d.hide()),"1"==r.mf_mail_poet?(L.attr("checked",!0),p.show()):(L.removeAttr("checked"),p.hide()),r.ckit_opt){let t=e("select.mf-ckit-list-id").first(),i=r.mf_ckit_list_id||"";t.html(),r.ckit_opt.forEach(function(e){t.append('<option value="'+e.id+'">'+e.name+"</option>")}),t.val(i)}if(r.aweber_opt){let t=e("select.mf-aweber-list-id").first(),i=r.mf_aweber_list_id||"";t.html();for(let e in r.aweber_opt)t.append('<option value="'+r.aweber_opt[e].id+'">'+r.aweber_opt[e].name+"</option>");t.val(i)}if(r.mp_opt){let t=e("select.mf-mail-poet-list-id").first(),i=r.mf_mail_poet_list_id||"";t.html();for(let e in r.mp_opt)t.append('<option value="'+r.mp_opt[e].id+'">'+r.mp_opt[e].name+"</option>");t.val(i)}var P=e(".mf-form-modalinput-active_campaign");"1"==r.mf_active_campaign?P.attr("checked",!0):P.removeAttr("checked");var z=e(".mf-form-modalinput-get_response");"1"==r.mf_get_response?(z.attr("checked",!0),e(".mf-get_response").show()):(z.removeAttr("checked"),e(".mf-get_response").hide());var N=e(".mf-hubsopt");"1"==r.mf_hubspot?N.attr("checked",!0):N.removeAttr("checked");var W=e(".mf-hubspot-forms"),E=e(".hubspot_forms_section");"1"==r.mf_hubspot_forms?(W.attr("checked",!0),E.show()):(W.removeAttr("checked"),E.hide()),e(".mf_hubspot_form_portalId").val(r.mf_hubspot_form_portalId),e(".mf_hubspot_form_guid").val(r.mf_hubspot_form_guid);var X=e(".mf-zoho");"1"==r.mf_zoho?X.attr("checked",!0):X.removeAttr("checked");var S=e(".mf-register");1==r.mf_registration?(S.attr("checked",!0),e(".mf_register_form_fields").show()):(S.removeAttr("checked"),e(".mf_register_form_fields").hide());var I=e(".mf-login");1==r.mf_login?(I.attr("checked",!0),e(".mf_login_form_fields").show()):(e(".mf_login_form_fields").hide(),I.removeAttr("checked"));var D=e(".mf-form-modalinput-zapier");"1"==r.mf_zapier?(D.attr("checked",!0),n.show()):(D.removeAttr("checked",!0),n.hide());var O=e(".mf-form-modalinput-slack");"1"==r.mf_slack?(O.attr("checked",!0),m.show()):(O.removeAttr("checked",!0),m.hide());var U=e(".mf-form-modalinput-paypal");"1"==r.mf_paypal?(U.attr("checked",!0),l.show()):(U.removeAttr("checked",!0),l.hide());var q=e(".mf-form-modalinput-stripe");"1"==r.mf_stripe?(q.attr("checked",!0),c.show()):(q.removeAttr("checked",!0),c.hide());q=e(".mf-form-modalinput-stripe");"1"==r.mf_stripe?(q.attr("checked",!0),c.show()):(q.removeAttr("checked",!0),c.hide());var R=e(".mf-form-modalinput-paypal_sandbox");"1"==r.mf_paypal_sandbox?R.attr("checked",!0):R.removeAttr("checked",!0);var Q=e(".mf-form-modalinput-stripe_sandbox");"1"==r.mf_stripe_sandbox?Q.attr("checked",!0):Q.removeAttr("checked",!0);var G=r.mf_rest_api_method&&r.mf_rest_api_method.length?r.mf_rest_api_method:"POST";e('.mf-rest-api-method option[value="'+G+'"]').prop("selected",!0),e(".mf-rest-api-url").val(r.mf_rest_api_url),e(".mf-mailchimp-api-key").val(r.mf_mailchimp_api_key),e(".mf-mailchimp-list-id").val(r.mf_mailchimp_list_id),""==r.mf_mailchimp_list_id&&e(".mf-mailchimp-list-id").val(e(".mailchimp_list").find(":selected").val()),0!=r.mf_mailchimp_list_id&&e('.mailchimp_list option[value="'+r.mf_get_response_list_id+'"]').prop("selected",!0),e(".mf-get_response-list-id").val(r.mf_get_response_list_id),0!=r.mf_get_response_list_id&&e('.get-response-campaign-list option[value="'+r.mf_get_response_list_id+'"]').prop("selected",!0),e(".mf-zapier-web-hook").val(r.mf_zapier_webhook),e(".mf-slack-web-hook").val(r.mf_slack_webhook),e(".mf-paypal-email").val(r.mf_paypal_email),e(".mf-paypal-token").val(r.mf_paypal_token),e(".mf-stripe-image-url").val(r.mf_stripe_image_url),e(".mf-stripe-live-publishiable-key").val(r.mf_stripe_live_publishiable_key),e(".mf-stripe-live-secret-key").val(r.mf_stripe_live_secret_key),e(".mf-stripe-test-publishiable-key").val(r.mf_stripe_test_publishiable_key),e(".mf-stripe-test-secret-key").val(r.mf_stripe_test_secret_key),e(".mf-recaptcha-site-key").val(r.mf_recaptcha_site_key),e(".mf-recaptcha-secret-key").val(r.mf_recaptcha_secret_key),e("input.mf-form-modalinput-limit_status, .mf-form-modalinput-rest_api").trigger("change")}}e("input.mf-form-modalinput-store_entries").on("change",function(){e(this).is(":checked")?t.show():e(this).is(":not(:checked)")&&t.hide()}),e("input.mf-form-modalinput-limit_status").on("change",function(){e(this).is(":checked")?e("#limit_status").find("input").removeAttr("disabled"):e(this).is(":not(:checked)")&&e("#limit_status").find("input").attr("disabled","disabled")}),e("input.mf-form-user-enable").on("change",function(){e(this).is(":checked")?i.show():e(this).is(":not(:checked)")&&i.hide()}),e("input.mf-form-admin-enable").on("change",function(){e(this).is(":checked")?a.show():e(this).is(":not(:checked)")&&a.hide()}),e("input.mf-form-modalinput-rest_api").on("change",function(){e(this).is(":checked")?o.show():e(this).is(":not(:checked)")&&o.hide()}),e("input.mf-form-modalinput-mail_chimp").on("change",function(){e(this).is(":checked")?s.show():e(this).is(":not(:checked)")&&s.hide()}),e(".mf-form-modalinput-get_response").on("change",function(){e(this).is(":checked")?r.show():r.hide()}),e("input.mf-form-modalinput-mail_aweber").on("change",function(){e(this).is(":checked")?d.show():e(this).is(":not(:checked)")&&d.hide()}),e("input.mf-form-modalinput-mail_poet").on("change",function(){e(this).is(":checked")?p.show():e(this).is(":not(:checked)")&&p.hide()}),e("input.mf-form-modalinput-ckit").on("change",function(){e(this).is(":checked")?f.show():e(this).is(":not(:checked)")&&f.hide()}),e("input.mf-form-modalinput-zapier").on("change",function(){e(this).is(":checked")?n.show():e(this).is(":not(:checked)")&&n.hide()}),e("input.mf-form-modalinput-slack").on("change",function(){e(this).is(":checked")?m.show():e(this).is(":not(:checked)")&&m.hide()}),e("input.mf-form-modalinput-paypal").on("change",function(){e(this).is(":checked")?l.show():e(this).is(":not(:checked)")&&l.hide()}),e("input.mf-form-modalinput-stripe").on("change",function(){e(this).is(":checked")?stripe.show():e(this).is(":not(:checked)")&&stripe.hide()}),e("input.mf-form-modalinput-stripe_sandbox").on("change",function(){e(this).is(":checked")?e(".mf_stripe_sandbox").show():e(this).is(":not(:checked)")&&e(".mf_stripe_sandbox").hide()}),e(".mf-hubspot-forms").on("change",function(){e(this).is(":checked")?e(".hubspot_forms_section").show():e(".hubspot_forms_section").hide()}),e(".mf-register").on("change",function(){e(this).is(":checked")?e(".mf_register_form_fields").show():e(".mf_register_form_fields").hide()}),e(".mf-login").on("change",function(){e(this).is(":checked")?e(".mf_login_form_fields").show():e(".mf_login_form_fields").hide()}),e(".get-response-campaign-list").on("change",function(){e(".mf-get_response-list-id ").val(e(this).val())}),e("input.mf-form-modalinput-capture_user_browser_data").click(function(){e(this).is(":checked")?(e("#multiple_submission").removeClass("hide_input"),e("#multiple_submission").addClass("show_input")):e(this).is(":not(:checked)")&&(e("#multiple_submission").removeClass("show_input"),e("#multiple_submission").addClass("hide_input"))}),e(".mf-settings-tab .mf-setting-nav-link").on("click",function(t){if(!e(this).hasClass("mf-setting-nav-hidden")){t.preventDefault();var i=e(this).attr("href");window.location.hash=i,e(this).parent().addClass("nav-tab-active").siblings().removeClass("nav-tab-active"),e(i).addClass("active").siblings().removeClass("active")}}),e(".mf-setting-nav-link").on("click",function(t){e(this).hasClass("mf-setting-nav-hidden")?t.preventDefault():(e(this).parents(".nav-tab-wrapper").find("a").removeClass("top").removeClass("bottom"),e(this).parents("li").prev().find("a").addClass("top"),e(this).parents("li").next().find("a").addClass("bottom"))});var u=e(".mf-settings-tab .mf-setting-nav-link").eq(1).attr("href");if(window.location.hash&&(u=window.location.hash),e('.mf-settings-tab .mf-setting-nav-link[href="'+u+'"]').trigger("click"),e(window).on("resize.mfSettings",function(){e(".mf-setting-sidebar").css("width",e(".mf-setting-sidebar-column").width())}).trigger("resize.mfSettings"),e(".mf-setting-header").length>0){var h=e(".mf-setting-header").offset().top;e(window).scroll(function(){var t=e(".mf-setting-header");e(window).scrollTop()>=h?t.addClass("fixed").css({width:jQuery(".metform-admin-container").width()}):t.removeClass("fixed").css({width:"auto"})})}e(".mf-admin-single-accordion").on("click",".mf-admin-single-accordion--heading",function(){e(this).next().slideToggle().parent().toggleClass("active").siblings().removeClass("active").find(".mf-admin-single-accordion--body").slideUp()}),e(".mf-admin-single-accordion:first-child .mf-admin-single-accordion--heading").trigger("click"),e(".mf-recaptcha-version").on("change",function(){var t=e(this).val();e("#mf-"+t).fadeIn().siblings().hide()}),e(".mf-recaptcha-version").trigger("change"),e(".mf-form-modalinput-stripe_sandbox").on("change",function(){var t=e(this).parents(".attr-form-group").eq(0).next(".mf-form-modalinput-stripe_sandbox_keys");e(this).is(":checked")?t.fadeIn():t.fadeOut()}),e(".mf-form-modalinput-stripe_sandbox").trigger("change"),e(document).on("click","#met_pro_aweber_authorize",function(t){t.preventDefault();let i=e(this).closest("p.description");i.html("<span>Wait....</span>");var a=metform_api.admin_url+"admin-ajax.php",o={action:"get_aweber_authorization_url",api_key:e("#mf_aweber_dev_api_key").val(),api_sec:e("#mf_aweber_dev_api_sec").val()};e.ajax({url:a,method:"POST",data:o,dataType:"json",success:function(e){if(!0===e.success){let t='<a class=" button mf-setting-btn-link" href="'+e.data.url+'">Authorize The App </a>';i.html(t)}else if(e.data){let t=e.data;i.html('<span style="background-color: red; padding: 1px 5px;">'+t.msg+"</span>")}},error:function(e){i.html('<span style="color: red"> ajax error occurred, please check your internet connection..</span>')},complete:function(){}})}),e(document).on("click","#met_pro_aweber_propmpt_re_auth",function(t){t.preventDefault(),e("#mf_aweber_dev_api_key").val("").prop("disabled",!1),e("#mf_aweber_dev_api_sec").val("").prop("disabled",!1),e(this).closest("p.description").html('<a class="button mf-setting-btn-link" id="met_pro_aweber_re_authorize"> Get Re - Authorization URL </a>')}),e(document).on("click","#met_pro_aweber_re_authorize",function(t){t.preventDefault();let i=e(this).closest("p.description");i.html("<span>Wait....</span>");let a=e("#mf_aweber_dev_api_key").val();if(!a||a.length<1)return i.html('<span style="color: red">API Key can not be empty..</span>'),!1;var o=metform_api.admin_url+"admin-ajax.php",s={action:"get_aweber_re_authorization_url",api_key:a,api_sec:e("#mf_aweber_dev_api_sec").val()};e.ajax({url:o,method:"POST",data:s,dataType:"json",success:function(e){if(!0===e.success){let t=e.data;if("ok"==t.result){let e='<a class="mf-setting-btn-link" href="'+t.url+'">Authorize The App </a>';i.html(e)}else i.html("<span>"+t.msg+"</span>")}else if(e.data){let t=e.data;i.html('<span style="background-color: red; padding: 1px 5px;">'+t.msg+"</span>")}},error:function(e){i.html('<span style="color: red"> ajax error occurred, please check your internet connection..</span>')},complete:function(){}})}),e(document).on("click","#met_form_aweber_get_list",function(t){t.preventDefault();let i=e(this),a=e("#mf_aweber_info"),o=metform_api.admin_url+"admin-ajax.php";e.ajax({url:o,method:"POST",data:{action:"get_list_lists"},dataType:"json",success:function(e){if(!0===e.success){let t=e.data,o=i.closest("div.mf-aweber").find("select");if(o.html(""),t.lists)for(let e in t.lists)o.append('<option value="'+t.lists[e].id+'">'+t.lists[e].name+"</option>");a.html("")}else if(e.data){let t=e.data;a.html('<span style="background-color: red; padding: 1px 5px;">'+t.msg+"</span>")}},error:function(e){a.html('<span style="color: red"> ajax error occurred, please check your internet connection..</span>')},complete:function(){}})}),e(document).on("click","#met_form_mail_poet_get_list",function(t){t.preventDefault();let i=e(this),a=e("#mf_mail_poet_info"),o=metform_api.admin_url+"admin-ajax.php";e.ajax({url:o,method:"POST",data:{action:"mail_poet_get_email_list_lists"},dataType:"json",success:function(e){if(!0===e.success){let t=e.data,o=i.closest("div.mf-mail-poet").find("select");if(o.html(""),t.lists)for(let e in t.lists)o.append('<option value="'+t.lists[e].id+'">'+t.lists[e].name+"</option>");a.html("")}else if(e.data){let t=e.data;a.html('<span style="background-color: red; padding: 1px 5px;">'+t.msg+"</span>")}},error:function(e){a.html('<span style="color: red"> ajax error occurred, please check your internet connection..</span>')},complete:function(){}})}),e(document).on("click","#met_form_ckit_get_list",function(t){t.preventDefault();var i=metform_api.admin_url+"admin-ajax.php";let a=e(this);e.ajax({url:i,method:"POST",data:{action:"get_form_lists"},dataType:"json",success:function(e){if(!0===e.success){let t=e.data,i=a.closest("div.mf-ckit").find("select");i.html(""),t.forms&&t.forms.forEach(function(e){i.append('<option value="'+e.id+'">'+e.name+"</option>")})}else alert("Error occurred when trying to check for aweber authorization."),console.log("hmmmm..... error occurred")},error:function(e){},complete:function(){}})})});