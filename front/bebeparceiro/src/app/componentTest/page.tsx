'use client';
import { useState } from "react";
import { phoneValidator, Phone } from "../validations/phone";
import DateInput from "../components/dateInput";
import PhoneInput from "../components/phoneInput";

export default function Login() {
    const [teste, setTeste] = useState<Phone>("");
    
    return(
        <div className="h-[100vh] flex flex-col justify-center items-center w--[100vw]">
            <div className="absolute top-0 right-0 p-4">
                <h1>Visualizador de dados</h1>
                <span>{teste}</span>
            </div>
            <div className="w-[100px]">
                <PhoneInput value={teste} label="Telefone" changeHandler={setTeste} required/>
            </div>
        </div>
    );
}