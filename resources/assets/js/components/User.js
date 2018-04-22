import React, { Component } from "react";
import ReactDOM from "react-dom";
import Axios from "axios";

export default class User extends React.Component {
  constructor() {
    super();
    this.state = { data: [] };
  }
  componentWillMount() {
    let $this = this;
    Axios.get("../api/users")
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
        <h2>User Listing</h2>
        <a href="/users/create" className="btn btn-primary">
          Add New User
        </a>
        <table className="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Birthday</th>
              <th>Name</th>
              <th>Email</th>
              <th>Team</th>
              <th>Roles</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {this.state.data.map((user, i) => (
              <tr>
                <td>{user.id}</td>
                <td>
                  <img
                    src={"/storage/profile_image/" + user.profile_image}
                    alt=""
                    className="img-circle-like"
                  />
                </td>
                <td>{user.birthday}</td>
                <td>{user.name}</td>
                <td>{user.email}</td>
                <td>{user.team.name}</td>
                <td>{user.roles.map((role, i) => <li>{role.name}</li>)}</td>
                <td>
                  <select>
                    <option value="volvo">admin</option>
                    <option value="saab">maneger</option>
                    <option value="mercedes">User</option>
                  </select>
                </td>
                <td>
                  <a href="" className="btn btn-primary">
                    Edit
                  </a>
                  ||
                  <a href="" className="btn btn-danger">
                    Delete
                  </a>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    );
  }
}
if (document.getElementById("app")) {
  ReactDOM.render(<User />, document.getElementById("app"));
}
