import React from 'react';
import * as RoutingConst from "../const/RoutingConst";

class LoginForm extends React.Component {
    constructor(props) {
        super(props);
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.state = {
            token: ''
        }
    }

    handleChange(event) {
        const target = event.target;
        const name = target.name;
        const value = target.value;

        this.setState({
            [name]: value
        });
    }

    handleSubmit(event) {
        event.preventDefault();
        const data = this.state;
        fetch(RoutingConst.API_ROUTE + RoutingConst.AUTH_ROUTE, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        }).then(
            res => res.json()
        ).then(
            json => this.setState({ token: json.token })
        ).then(
            () => {window.sessionStorage.setItem('token', this.state.token)}
        );
    }

    render() {
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                    <label htmlFor="email">Enter your email</label>
                    <input type="text" name="email" onChange={this.handleChange} />
                    <label htmlFor="password">Enter your password</label>
                    <input type="text" name="password" onChange={this.handleChange} />

                    <input type="submit" value="Login" />
                </form>
            </div>
        );
    }
}

export default LoginForm