$(document).ready(function() {
 $("#btn-login").click(function() {
  var e = $("#login-username").val(),
  a = $("#login-password").val(),
  t = ($("#login-remember").val(), "action=login&email=" + e + "&password=" + a + "&remember=" + t);
  return $.trim(e).length > 0 && $.trim(a).length > 0 ? $.ajax({
   type: "POST",
   url: "action.php",
   data: t,
   cache: !1,
   beforeSend: function() {
    $("#btn-login").attr("disabled", !0),
    $("#btn-login").html("<i class='fa fa-sign-in'></i> Loading..."),
    $("#login-alert").removeClass(),
    $("#login-alert").css("display", "block"),
    $("#login-alert").css("text-align", "center"),
    $("#login-alert").html('<img src="/icon/squares.gif" alt="loading...">')
   },
   success: function(e) {
    e ? "true" == e ? (
     $("#btn-login").html("<i class='fa fa-sign-in'></i> Logging..."),
     $("#login-alert").removeClass(),
     $("#login-alert").addClass("alert alert-success"),
     $("#login-alert").html('You have successfully logged in.<br/><i class="fa fa-spinner fa-spin fa-2x"></i>'),
     $("#login-alert").css("display", "block"), setTimeout(function() {
      location.reload()
     }, 3e3),
     $("#btn-login").attr("disabled", !0),
     $("#login-username").attr("disabled", !0),
     $("#login-password").attr("disabled", !0),
     $("#login-alert").addClass("alert"),
     $("#login-alert").addClass("alert-warning"),
     $("#login-remember").attr("disabled", !0)) : ($("#login-alert").addClass("alert alert-warning"),
     $("#login-alert").html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Username/Email &amp; Password Incorrect."),
     $("#btn-login").attr("disabled", !1),
     $("#btn-login").html("<i class='fa fa-sign-in'></i> Login"),
     $("#btn-login").attr("disabled", !1)
    ) : (
     $("#btn-login").html("<i class='fa fa-sign-in'></i> Login"),
     $("#login-alert").html("<i class='icon-warning-sign'></i> There is an SQL error!"),
     $("#btn-login").attr("disabled", !1)
    )
   }
}) : (
   $("#login-alert").html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Username/Email &amp; Password required!"),
   $("#login-alert").show('fast')), !1
})
});

