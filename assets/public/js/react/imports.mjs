
import * as ReactPDF from "https://esm.sh/react-pdf@9.1.0";
export * as ReactQrScanner from "https://esm.sh/@yudiel/react-qr-scanner@2.0.8";
export { default as ReactDOM } from "https://esm.sh/react-dom@18.3.1/client";
export { default as React } from "https://esm.sh/react@18.3.1";
export { default as Swal } from "https://esm.sh/sweetalert2@11.12.4";

ReactPDF.pdfjs.GlobalWorkerOptions.workerSrc = new URL(
  'https://esm.sh/pdfjs-dist@4.4.168/build/pdf.worker.min.mjs',
  import.meta.url,
).toString()

export {
  ReactPDF
};

