import { LOGIN } from "./ActionType"

const initstate = {
    isLogged: false,
    user : null
}


const Reducer = (state = initstate, action) => {
    switch(action.type){
        case LOGIN:
            return{
                ...state,isLogged: true , user: action.payload
            }

        default :
            return state
    }
}

export default Reducer