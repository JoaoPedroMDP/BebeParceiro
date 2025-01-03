'use client';
import { useEffect, useState } from "react";
import ValidationResult from "../types/validationResult";
import { error } from "console";

interface TextInputProps {
    label: string;
    value: string;
    onChange: (value: string) => void;
    validator?: (value: string) => ValidationResult;
    required?: boolean;
}

export default function TextInput(props: Readonly<TextInputProps>) {
    const required = props.required !== undefined;
    const [fieldAnnotation, setFieldAnnotation] = useState<string>("");
    const [isValid, setIsValid] = useState<boolean|undefined>(undefined);
    const [errorMessage, setErrorMessage] = useState<string|undefined>(undefined);
    const [showErrorMessage, setShowErrorMessage] = useState<boolean>(false);

    useEffect(() => {
        if(isValid) {
            setFieldAnnotation("✓");
        }else {
            setFieldAnnotation("✗");
        }
    }, [isValid]);

    function changeContent(newContent: string) {
        props.onChange(newContent);
    }

    function handleChange(event: React.ChangeEvent<HTMLInputElement>) {
        const value = event.target.value;

        if (props.validator) {
            const validation: ValidationResult = props.validator(value);
            setIsValid(validation.isValid);
            setErrorMessage(validation.message);
        }

        changeContent(value);
    }

    function handleMarkStart(){
        if(errorMessage){
            setShowErrorMessage(true);
        }
    }

    function handleMarkEnd(){
        setShowErrorMessage(false);
    }

    // Defino a cor da borda baseado na validação.
    let borderColor = "border-black";
    // Defino a marca de validade do campo.
    let validityMark = "";
    let validityMarkStyle = "";
    if(isValid === false ) {
        validityMarkStyle = "animate-grow cursor-pointer";
        validityMark = '⚠️';
        borderColor = "border-wrongRed";
    }else if(isValid === true) {
        validityMarkStyle = "text-rightGreen text-xl bg-white";
        validityMark = '✔';
        borderColor = "border-rightGreen";
    }

    // Defino o asterisco de campo obrigatório.
    let requiredMark = required ? "after:content-['*'] after:font-bold after:text-wrongRed" : '';

    return (
        <div className="m-2 relative w-[100%]">
            <label className={`absolute px-1 left-2 -top-2 leading-none touch-pan-down bg-white ${requiredMark}`}>{props.label}</label>
            <div className="flex flex-col">
                <span 
                    hidden={!showErrorMessage || errorMessage === undefined} 
                    className="-top-2 z-10 rounded-lg p-2 absolute text-black font-bold text-[12px] 
                        max-w-[200px] break-words bg-warningYellow"
                >{isValid ? '' : errorMessage}</span>
                <span 
                    onTouchStart={handleMarkStart} 
                    onTouchEnd={handleMarkEnd} 
                    onTouchCancel={handleMarkEnd}
                    onMouseEnter={handleMarkStart}
                    onMouseLeave={handleMarkEnd}
                    className={`absolute -left-6 top-2 ${validityMarkStyle}`}
                >{validityMark}</span>
                <input 
                    className={`p-2 border-solid border-[3px] rounded-lg ${borderColor} focus:outline-dashed focus:outline-2 focus:outline-blue-500`} 
                    type="text" 
                    value={props.value} 
                    onChange={handleChange} />
            </div>

        </div>
    );
}