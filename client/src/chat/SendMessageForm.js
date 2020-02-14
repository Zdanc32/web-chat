import React from 'react';
import * as RoutingConst from "../const/RoutingConst";

class SendMessageForm extends React.Component {
    constructor(props) {
        super(props);
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
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
        fetch(RoutingConst.API_ROUTE + RoutingConst.CHAT_ROUTE, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + window.sessionStorage.getItem('token')
            },
            body: JSON.stringify(data),
        }).then()
    }

    render() {
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                    <input type="text" name="text" onChange={this.handleChange} />

                    <input type="submit" value="Send" />
                </form>
            </div>
        );
    }
}

export default SendMessageForm