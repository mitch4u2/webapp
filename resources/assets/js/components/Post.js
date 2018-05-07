import React, { Component } from "react";
import ReactDOM from "react-dom";
import Axios from "axios";

export default class Post extends React.Component {
  constructor() {
    super();
    this.state = { data: [] };
  }
  componentWillMount() {
    let $this = this;
    Axios.get("api/posts")
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
      <ul className="media-list">
        {this.state.data.map((post, i) => (
          <li className="media well">
            <a href={"/users/" + post.user.id} className="pull-left">
              <img
                src={
                  "gs://office-manager-web-app.appspot.com/" +
                  post.user.profile_image
                }
                alt=""
                className="img-circle"
              />
            </a>
            <div className="media-body">
              <span className="text-muted pull-right">
                <small className="text-muted">{post.created_at}</small>
              </span>
              <strong className="text-success">{post.user.name}</strong>
              <br />
              <small className="text-default">Design Team</small>
            </div>
            <br />
            <hr />
            <p>{post.body}</p>
            <img
              style={{ width: "100%" }}
              class="post-media"
              src={"/storage/cover_image/" + post.cover_image}
              alt=""
            />

            <hr />
            <ul className="list-inline">
              <li>
                <button
                  type="button"
                  className="btn btn-default btn-sm btn-like"
                >
                  <span
                    className="glyphicon glyphicon-thumbs-up"
                    aria-hidden="true"
                  />
                </button>
              </li>
              <li className="list-inline-item">
                <img
                  src="https://www.w3schools.com/w3images/avatar2.png"
                  alt=""
                  className="img-circle-like"
                />
                <img
                  src="https://www.w3schools.com/w3images/avatar2.png"
                  alt=""
                  className="img-circle-like"
                />
                <img
                  src="https://www.w3schools.com/w3images/avatar2.png"
                  alt=""
                  className="img-circle-like"
                />
              </li>
            </ul>

            <ul className="list-inline pull-right">
              <li className="list-inline-item">
                <img
                  src="https://www.w3schools.com/w3images/avatar2.png"
                  alt=""
                  className="img-circle-like"
                />
                <img
                  src="https://www.w3schools.com/w3images/avatar2.png"
                  alt=""
                  className="img-circle-like"
                />
              </li>
              <li>
                <button
                  type="button"
                  className="btn btn-default btn-sm btn-dislike"
                >
                  <span
                    className="glyphicon glyphicon-thumbs-down"
                    aria-hidden="true"
                  />
                </button>
              </li>
            </ul>
            <br />
            <br />
            <hr />
            <div className="input-group">
              <span className="input-group-btn">
                <button className="btn btn-default" type="button">
                  Go!
                </button>
              </span>
              <input
                type="text"
                className="form-control"
                placeholder="Search for..."
              />
            </div>
          </li>
        ))}
      </ul>

      // <div>
      //   <h1>Posts</h1>

      //   {this.state.data.map((post, i) => (
      //     <div className="well">
      //       <div className="row">
      //         <div className="col-md-4 col-sm-6">
      //           <img
      //             style={{ width: "100%" }}
      //             src={"/storage/cover_image/" + post.cover_image}
      //             alt=""
      //           />
      //         </div>
      //         <div className="col-md-8 col-sm-8">
      //           <h3>
      //             <a href={"/posts/" + post.id}> {post.title}</a>
      //           </h3>
      //           <small>
      //             Written on {post.created_at} by {post.user.name}
      //           </small>
      //         </div>
      //       </div>
      //     </div>
      //   ))}
      // </div>
    );
  }
}
if (document.getElementById("posts")) {
  ReactDOM.render(<Post />, document.getElementById("posts"));
}
