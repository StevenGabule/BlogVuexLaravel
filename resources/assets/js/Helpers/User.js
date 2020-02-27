import AppStorage from "./AppStorage";
import Token from "./Token";
import axios from "axios";

class User {
    hasToken() {
        const storeToken = AppStorage.getToken();
        if (storeToken) {
            return !!Token.isValid(storeToken);
        }
        return false
    }

    loggedIn() {
        return this.hasToken();
    }

    logout() {
        AppStorage.clear();
    }

    name() {
        if (this.loggedIn()) {
            return AppStorage.getUser();
        }
    }

    id() {
        if (this.loggedIn()) {
            return Token.payload(AppStorage.getToken()).sub;
        }
    }
}


export default User = new User;
