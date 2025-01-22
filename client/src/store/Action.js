import { LOGIN } from "./ActionType"

export const login=(obj)=>{
    return{
        type:LOGIN,
        payload: obj
    }
}