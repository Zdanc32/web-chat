import * as React from "react";
import RegisterForm from "./logowanie/RegisterForm";
import LoginForm from "./logowanie/LoginForm";
import ChatForm from "./chat/ChatForm";
import SendMessageForm from "./chat/SendMessageForm";


const App = () => {
    return (
        <div className="container">
            <h1>CRUD App with Hooks</h1>
            <div className="flex-row">
                <div className="flex-large">
                    <h2>Add user</h2>
                    <RegisterForm />
                </div>
                <div className="flex-large">
                    <h2>Login</h2>
                    <LoginForm/>
                </div>
                <div className="flex-large">
                    <h2>Chat</h2>
                    <ChatForm/>
                </div>
                <div className="flex-large">
                    <h2>Send message</h2>
                    <SendMessageForm/>
                </div>
            </div>
        </div>
    )
};

export default App