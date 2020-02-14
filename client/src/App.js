import * as React from "react";
import RegisterForm from "./logowanie/RegisterForm";
import LoginForm from "./logowanie/Login";
import ChatForm from "./chat/Chat";


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
                    <h2>Login</h2>
                    <ChatForm/>
                </div>
            </div>
        </div>
    )
};

export default App