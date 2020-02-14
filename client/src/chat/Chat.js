import React from 'react';
import * as RoutingConst from "../const/RoutingConst";

class ChatForm extends React.Component {
    constructor(props) {
        super(props);
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.state = {
            token: window.sessionStorage.getItem('token'),
            chats: []
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
        fetch(RoutingConst.API_ROUTE + RoutingConst.CHAT_ROUTE, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + this.state.token
            }
        }).then(
            res => res.json()
        ).then(
            json => this.setState({ chats: json.results })
        );
    }

    render() {
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                    <input type="submit" value="send" />
                </form>
                <span>{ console.log(this.state.chats) }</span>
            </div>
        );
    }
}

export default ChatForm