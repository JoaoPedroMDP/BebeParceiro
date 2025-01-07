import { phoneValidator } from "../validations/phone";
import Text, { TextProps } from "./base/text";
import { maskitoChangeEventPlugin, MaskitoOptions } from "@maskito/core";
import {maskitoWithPlaceholder} from '@maskito/kit';


const phoneMask: MaskitoOptions = {
    ...maskitoWithPlaceholder('(__) _____-____'),
    mask: [
        '(', /\d/, /\d/, ')', ' ', /\d?/, /\d/, /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/
    ],
    preprocessors: [
        (elementState) => {console.log(elementState); return elementState;}
    ],
    plugins: [
        maskitoChangeEventPlugin()
    ],
};

export default function PhoneInput(props: Readonly<TextProps>) {
    return (
        <Text {...props} mask={phoneMask} validator={phoneValidator} />
    );
}