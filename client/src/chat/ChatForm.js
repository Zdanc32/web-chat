import React from 'react';
import * as RoutingConst from "../const/RoutingConst";
import moment from "moment";
import {EventSourcePolyfill} from "event-source-polyfill";

class ChatForm extends React.Component {
    eventSource;

    constructor(props) {
        super(props);
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.state = {
            chats: []
        };
        this.handleSubmit();
        this.subscribeToMessages();
    }

    handleChange(event) {
        const target = event.target;
        const name = target.name;
        const value = target.value;

        this.setState({
            [name]: value
        });
    }

    subscribeToMessages() {
        this.eventSource = new EventSourcePolyfill(
            'http://localhost:3000/.well-known/mercure?topic='
            + encodeURIComponent('http://api.web-chat.com/api/chats'), {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' +  'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InN1YnNjcmliZSI6WyIqIl0sInB1Ymxpc2giOlsiKiJdfX0.O4JY6lfCFukf21NfGQLOe4SVsoAzyHb8P2EKUo1aXFg'
                }
            });
        this.eventSource.onmessage = e => {
            console.log(e);
            this.updateChats(e.data);
        }
    }

    handleSubmit() {
        this.eventSource = null;
        fetch(RoutingConst.API_ROUTE + RoutingConst.CHAT_ROUTE, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + window.sessionStorage.getItem('token'),
            }
        }).then(
            res => res.json()
        ).then(
            json => {this.setState({ chats: json })}
        );
    }

    updateChats(msg) {
        this.state.chats.push(msg);
    }

    render() {
        return (
            <div>
                {this.state.chats.map((item, key) =>
                    <div key={key}>{item.user.email}: {item.text} ({moment(item.createdAt).format('MMM Do YYYY, h:mm:ss a')})
                    </div>)
                }
            </div>
        );
    }
}

export default ChatForm