'use client';
import { useState } from "react";
import TextInput from "../components/textInput";
import { phoneValidator, Phone } from "../validations/phone";

export default function Login() {
    const [teste, setTeste] = useState<Phone>("");
    const [teste2, setTeste2] = useState<Phone>("");
    return(
        <div className="h-[100vh] flex flex-col justify-center items-center w--[100vw]">
            <div className="absolute top-0 right-0 p-4">
                <h1>Visualizador de dados</h1>
                <span>{teste}</span>
            </div>
            <div className="w-[100px]">
                <TextInput label={"Teste"} value={teste} onChange={setTeste} validator={phoneValidator} required/>
                <TextInput label={"Teste"} value={teste2} onChange={setTeste2} validator={phoneValidator} />
            </div>
        </div>
    );
}