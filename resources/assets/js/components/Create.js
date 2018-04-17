import React, { Component } from "react";
import ReactDOM from "react-dom";
import Axios from "axios";

export default class Create extends React.Component {
  constructor() {
    super();
    this.state = { data: [] };
  }
  componentWillMount() {
    let $this = this;
    Axios.get("api/users")
      .then(Response => {
        $this.setState({
          data: Response.data
        });
      })
      .catch(error => {
        console.log(error);
      });
  }
  render() {
    return (
      <div>
        <h2>Add New User</h2>
        <form className="form-horizontal">
          <div className="form-group">
            <label className="control-label col-sm-2" for="name">
              Name:
            </label>
            <div className="col-sm-10">
              <input
                type="text"
                className="form-control"
                id="name"
                placeholder="Enter Name"
                name="name"
              />
            </div>
          </div>

          <div className="form-group">
            <label className="control-label col-sm-2" for="email">
              Email:
            </label>
            <div className="col-sm-10">
              <input
                type="email"
                className="form-control"
                id="email"
                placeholder="Enter email"
                name="email"
              />
            </div>
          </div>

          <div className="form-group">
            <label className="control-label col-sm-2" for="pwd">
              Password:
            </label>
            <div className="col-sm-10">
              <input
                type="password"
                className="form-control"
                id="password"
                placeholder="Enter password"
                name="password"
              />
            </div>
          </div>

          <div className="form-group">
            <div className="col-sm-offset-2 col-sm-10">
              <button type="submit" className="btn btn-default" value="Save" />
            </div>
          </div>
        </form>
      </div>
    );
  }
}
ReactDOM.render(<Create />, document.getElementById("app"));
