'use client';
import { useState } from "react";
import { Phone } from "../validations/phone";
import DateInput from "../components/dateInput";
import PhoneInput from "../components/phoneInput";
import Select from "../components/base/select";
import Button from "../components/base/button";

export default function Login() {
    const [text, setText] = useState<string>("");
    const [select, setSelect] = useState<string>("");
    const [button, setButton] = useState<boolean>(false);
    const [date, setDate] = useState<string>("");

    return(
        <div className="h-[100vh] flex flex-col justify-center items-center w--[100vw]">
            <div className="absolute top-0 right-0 p-4 flex flex-col">
                <h1>Visualizador de dados</h1>
                <span>Phone {text}</span>
                <span>Button {button ? 'true': 'false'}</span>
                <span>Select {select}</span>
                <span>Date {date}</span>
            </div>
            <div className="w-[100px]">
                <Select value={select} label="Seletor" changeHandler={setSelect} required options={['1', '2', '3']}/>
                <Button label="Botão" clickHandler={setButton}/>
                <PhoneInput value={text} label="Telefone" changeHandler={setText} required/>
                <DateInput value={date} label="Data" changeHandler={setDate} required/>
            </div>
        </div>
    );
}