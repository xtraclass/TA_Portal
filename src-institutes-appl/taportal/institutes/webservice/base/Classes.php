<?php

/**
 * This can be included in other php files, so that all php files
 * are included at once.
 */


require_once 'taportal/institutes/webservice/base/DataFormatSpecificationConstants.php';
require_once 'taportal/institutes/webservice/base/Vector.php';
require_once 'taportal/institutes/webservice/base/EntityBase.php';

require_once 'taportal/institutes/webservice/api/PublicationTypeEnum.php';

require_once 'taportal/institutes/webservice/api/Institute.php';
require_once 'taportal/institutes/webservice/api/Expert.php';
require_once 'taportal/institutes/webservice/api/Project.php';
require_once 'taportal/institutes/webservice/api/Publication.php';

require_once 'taportal/institutes/webservice/api/TheInstitutes.php';
require_once 'taportal/institutes/webservice/api/TheExperts.php';
require_once 'taportal/institutes/webservice/api/TheProjects.php';
require_once 'taportal/institutes/webservice/api/ThePublications.php';

require_once 'taportal/institutes/webservice/api/JSONBuilder.php';

require_once 'taportal/institutes/webservice/tests/FakedEntitiesMaker.php';

?>