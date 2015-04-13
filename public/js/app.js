(function () {
  $(document).ready(function () {
    var Router = Backbone.Router.extend({
      routes: {
        "item/:id"      : "item",
        "submit"        : "submit",
        "new"           : "new",
        "threads"       : "threads",
        "comments"      : "comments",
        "user/register" : "userRegister",
        "user/login"    : "userLogin",
        "user/forgot"   : "userForgot",
        "*actions"      : "home",
      }
    });

    var router = new Router();

    router.on("route:home", function () {
      console.log('home');
    });

    router.on("route:userRegister", function () {
      React.render(<RegisterForm/>, $('#app').get(0));
    });

    router.on("route:userLogin", function () {
      React.render(<LoginForm/>, $('#app').get(0));
    });

    router.on("route:userForgot", function () {
      React.render(<ForgotForm/>, $('#app').get(0));
    });

    router.on("route:submit", function () {
      React.render(<SubmitForm/>, $('#app').get(0));
    });

    Backbone.history.start();


    // React.render(<LoginForm/>, $('#app').get(0));
    
    // React.render(<ForgotForm/>, $('#app').get(0));

  });
}(jQuery));