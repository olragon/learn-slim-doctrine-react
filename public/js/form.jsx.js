var RegisterForm = React.createClass({
  getInitialState: function() {
    return {email: null, password: null};
  },
  handleClick: function (e) {
    var emailTxt = React.findDOMNode(this.refs.email);
    var passTxt = React.findDOMNode(this.refs.password);
    e.preventDefault();
  },
  render: function() {
    return (
      <form id="user-register">
        <fieldset>
          <legend>Register</legend>
          <p><label>email:</label><input type="email" ref="email" value={this.state.email}/></p>
          <p><label>password:</label><input type="password" ref="password" value={this.state.password}/></p>
          <button onClick={this.handleClick}>Register</button>
        </fieldset>
      </form>
    );
  }
});

var LoginForm = React.createClass({
  render: function() {
    return (
      <form id="user-login">
        <fieldset>
          <legend>Login</legend>
          <p><label>email:</label><input type="email" value={this.email}/></p>
          <p><label>password:</label><input type="password" value={this.password}/></p>
          <button>Login</button>
        </fieldset>
      </form>
    );
  }
});

var ForgotForm = React.createClass({
  render: function() {
    return (
      <form id="user-forgot">
        <fieldset>
          <legend>Forgot password</legend>
          <p><label>email:</label><input type="email" value={this.email}/></p>
          <button>Send reset email</button>
        </fieldset>
      </form>
    );
  }
});

var SubmitForm = React.createClass({
  getInitialState: function() {
    return {email: null, password: null};
  },
  handleClick: function (e) {
    var emailTxt = React.findDOMNode(this.refs.email);
    var passTxt = React.findDOMNode(this.refs.password);
    e.preventDefault();
  },
  render: function() {
    return (
      <form id="submit">
        <fieldset>
          <legend>Submit</legend>
          <p><label>title:</label><input type="title" ref="title" value={this.state.title}/></p>
          <p><label>url:</label><input type="url" ref="url" value={this.state.url}/></p>
          <p>or</p>
          <p><label>text:</label><textarea ref="text" value={this.state.text}/></p>
          <button onClick={this.handleClick}>submit</button>
          <p>
          Leave url blank to submit a question for discussion. If there is no url, the text (if any) will appear at the top of the thread.<br/>
          You can also submit via bookmarklet.
          </p>
        </fieldset>
      </form>
    );
  }
});