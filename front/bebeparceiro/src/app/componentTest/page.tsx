'use client';
import { useState } from "react";
import DateInput from "../../components/dateInput";
import PhoneInput from "../../components/phoneInput";
import Select from "../../components/base/select";
import Button from "../../components/base/button";
import { SelectOption } from "../types";
import Check from "@/components/base/check";

export default function Login() {
    const [text, setText] = useState<string>("");
    const [select, setSelect] = useState<string>("");
    const [button, setButton] = useState<boolean>(false);
    const [date, setDate] = useState<string>("");
    const [check, setCheck] = useState<boolean>(false);

    const options: SelectOption[] = [
        {value: '1', label: '1'},
        {value: '2', label: '2'},
        {value: '3', label: '3'}
    ]
    return(
        <div className="h-[100vh] flex flex-col justify-center items-center w--[100vw]">
            <div className="absolute top-0 right-0 p-4 flex flex-col">
                <h1>Visualizador de dados</h1>
                <span>Phone {text}</span>
                <span>Button {button ? 'true': 'false'}</span>
                <span>Select {select}</span>
                <span>Data {date}</span>
                <span>Check {check ? 'true': 'false'}</span>
            </div>
            <div className="w-[100px]">
                <Select value={select} label="Seletor" changeHandler={setSelect} required options={options}/>
                <Button label="Botão" clickHandler={setButton}/>
                <PhoneInput value={text} label="Telefone" changeHandler={setText} required/>
                <DateInput value={date} label="Data" changeHandler={setDate} required/>
                <Check label="Check" value={check} changeHandler={setCheck}/>
            </div>
        </div>
    );
}