import React, { Component } from "react";
import ReactDOM from "react-dom";
import Axios from "axios";

export default class CreatePost extends React.Component {
  constructor() {
    super();
    this.state = {
      body: "",
      cover_image: null
    };
  }
  handleBodyChange(e) {
    this.setState({
      body: e.target.value
    });
  }
  handleSubmit(e) {
    e.preventDefault();
    console.log(this.state);
    axios
      .post("/api/posts", { body: "hello mo" })
      .then(response => {
        console.log(response);
      })
      .then(error => {
        console.log(error);
      });
  }

  fileSelectedHandler(e) {
    cover_image: e.target.files[0];
  }
  render() {
    return (
      <div className="media well create-post">
        <a href="#" className="pull-left">
          <img
            src="data:image/png;base64,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"
            alt=""
            className="img-circle-post"
          />
        </a>
        <form onSubmit={this.handleSubmit.bind(this)}>
          <textarea
            id="body"
            name="body"
            placeholder="what's on your mind"
            value={this.state.body}
            onChange={this.handleBodyChange.bind(this)}
          />
          <hr />
          <input type="file" onChange={this.fileSelectedHandler} />
          <button
            type="submit"
            className="btn btn-primary pull-right"
            value="Post"
          >
            Post
          </button>
        </form>
      </div>
    );
  }
}
if (document.getElementById("createpost")) {
  ReactDOM.render(<CreatePost />, document.getElementById("createpost"));
}
