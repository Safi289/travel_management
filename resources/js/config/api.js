// const location = document.location.origin + '/';
const location = base_url + '/';
const json_path = location + 'json/';
const user = json_path + 'user/';
const api = {
    getThanas : json_path + 'get-upazilas/',
    getMahramList : json_path + 'get-customers-by-group-id/',
    getHajjPaymentStatus : json_path + 'get-hajj-payment-status/',
    getHajjPaymentDetails : json_path + 'get-hajj-payment-details',
    getPassportStatus : json_path + 'get-passport-current-status',
    getPassportStatusHistories : json_path + 'get-passport-status-history',
    isRegisteredPassport : json_path + 'is-registered-passport',
};
export default api;
